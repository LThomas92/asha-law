<?php
/**
 * Asha & Law functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Asha_&_Law
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function asha_law_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Asha & Law, use a find and replace
		* to change 'asha-law' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'asha-law', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'asha-law' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'asha_law_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'asha_law_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function asha_law_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'asha_law_content_width', 640 );
}
add_action( 'after_setup_theme', 'asha_law_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function asha_law_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'asha-law' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'asha-law' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'asha_law_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function laws_and_codes_scripts() {
	$manifest = json_decode(file_get_contents('dist/assets.json', true));
	$main = $manifest->main;

	wp_enqueue_style( 'laws-and-codes-style', get_template_directory_uri() . $main->css, false, null );

	wp_enqueue_script('veganease-js', get_template_directory_uri() . $main->js, ['jquery, slick-js'], null, true);
	wp_enqueue_style( 'slick-style',"//cdn.jsdelivr.net/jquery.slick/1.5.9/slick.css");
	wp_enqueue_script('slick-js', "//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js", ['jquery'], null, true);

	wp_enqueue_script('veganease-styles-js', get_template_directory_uri() . $main->js, ['jquery', 'slick-js'], null, true);

	wp_enqueue_script( 'laws-and-codes-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'laws_and_codes_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
  }

  function start_php_session() {
    if (!session_id()) {
        session_start();
    }
}
add_action('init', 'start_php_session', 1);

  function acf_quiz_shortcode($atts) {
    $a = shortcode_atts(['id' => 0], $atts);
    $quiz_id = intval($a['id']);

    if (!$quiz_id) return 'Quiz not found.';

    $questions = get_field('questions', $quiz_id);
    if (!$questions) return 'No questions found.';

    $current = isset($_GET['question']) ? intval($_GET['question']) : 1;
    $total = count($questions);

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer'])) {
        $_SESSION['quiz_answers'][$quiz_id][$current] = sanitize_text_field($_POST['answer']);
        error_log(print_r($_SESSION['quiz_answers'], true));  // Debugging session data
        
        // Go to next question
        if ($current < $total) {
            wp_redirect(add_query_arg('question', $current + 1));
        } else {
            wp_redirect(add_query_arg('question', 'done'));
        }
        exit;
    }

    ob_start();

<<<<<<< HEAD
// Show results
if ($_GET['question'] === 'done') {
  echo '<div class="c-single-quiz__last-msg">';
  echo '<h2 class="c-single-quiz__">Quiz Complete!</h2>';
  $answers = $_SESSION['quiz_answers'][$quiz_id] ?? [];
  $all_correct = true;

  foreach ($questions as $index => $q) {
      $user_answer = $answers[$index + 1] ?? '';
      $correct_answer = $q['correct_answer'];

      // Case-insensitive comparison (you can tweak this)
      if (strtolower(trim($user_answer)) !== strtolower(trim($correct_answer))) {
          $all_correct = false;
      }

      echo '<p class="c-single-quiz__last-msg-answer"><strong>Q' . ($index + 1) . ': ' . esc_html($q['question_text']) . '</strong><br>';
      echo 'Your Answer: ' . esc_html($user_answer ?: 'No answer') . '<br>';
      echo 'Correct Answer: ' . esc_html($correct_answer) . '</p>';
  }

  if ($all_correct) {
      echo '<p class="c-single-quiz__all-correct">🎉 Congratulations! You answered all questions correctly. Now just one last thing!</p>';
      echo '<button class="c-single-quiz__gf-btn">Open Me!</button>';
    }

  echo '</div>';
  session_destroy(); // Optional: clear answers after showing
  return ob_get_clean();
}

=======
    // Show results
    if ($_GET['question'] === 'done') {
        echo '<h2>Quiz Complete!</h2>';
        $answers = $_SESSION['quiz_answers'][$quiz_id] ?? [];
        foreach ($questions as $index => $q) {
            echo '<p><strong>Q' . ($index + 1) . ': ' . esc_html($q['question_text']) . '</strong><br>';
            echo 'Your Answer: ' . esc_html($answers[$index + 1] ?? 'No answer') . '<br>';
            echo 'Correct Answer: ' . esc_html($q['correct_answer']) . '</p>';
        }
        session_destroy(); // Optional: clear answers after showing
        return ob_get_clean();
    }

>>>>>>> 1ed9049009da8716cbc6c66b775371a2cee7e3f5
    // Show current question
    if (isset($questions[$current - 1])) {
        $q = $questions[$current - 1];
        echo '<form method="post">';
<<<<<<< HEAD
        echo '<h3 class="c-single-quiz__question">' . esc_html($q['question_text']) . '</h3>';

        if (!empty($q['answers'])) { 
            echo '<ul class="c-single-quiz__answers">';
            foreach ($q['answers'] as $a) {
                $value = esc_attr($a['answer_text']);
                echo "<label><input type='radio' name='answer' value='$value' required> $value</label>";
            }
            echo '</ul>';
=======
        echo '<p><strong>Question ' . $current . ' of ' . $total . '</strong></p>';
        echo '<p>' . esc_html($q['question_text']) . '</p>';

        if (!empty($q['answers'])) {
            foreach ($q['answers'] as $a) {
                $value = esc_attr($a['answer_text']);
                echo "<label><input type='radio' name='answer' value='$value' required> $value</label><br>";
            }
>>>>>>> 1ed9049009da8716cbc6c66b775371a2cee7e3f5
        }

        echo '<br><button type="submit">Next</button>';
        echo '</form>';
    } else {
        echo '<p>Invalid question number.</p>';
    }

    return ob_get_clean();
}
add_shortcode('acf_quiz', 'acf_quiz_shortcode');