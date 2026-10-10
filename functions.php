<?php
if (!defined('ABSPATH')) exit;
function habitfit_setup(){add_theme_support('title-tag');add_theme_support('post-thumbnails');add_theme_support('html5',array('style','script'));} add_action('after_setup_theme','habitfit_setup');
function habitfit_assets(){wp_enqueue_style('habitfit-style',get_stylesheet_uri(),array(),'1.0.0');wp_enqueue_script('habitfit-script',get_template_directory_uri().'/assets/js/script.js',array(),'1.0.0',true);} add_action('wp_enqueue_scripts','habitfit_assets');
function habitfit_seo(){
 if(is_admin())return;
 $data=array('title'=>'HabitFit | Beginner Fitness Plan, Home Workouts, and Healthy Habits','description'=>'Beginner fitness guide with a 4-week workout plan, at-home exercises, nutrition basics, habit tracking, and recovery tips.','keywords'=>'beginner fitness plan, fitness for beginners, at home workouts for beginners, 4 week beginner workout plan','type'=>'website');
 if(is_page('beginner-workout-plan'))$data=array('title'=>'4-Week Beginner Workout Plan | HabitFit','description'=>'A simple 4-week beginner workout plan with strength, mobility, walking, rest days, warm-ups, and progression tips.','keywords'=>'beginner workout plan, 4 week workout plan, fitness plan for beginners','type'=>'article');
 if(is_page('at-home-workouts'))$data=array('title'=>'At-Home Workouts for Beginners | HabitFit','description'=>'Beginner at-home workouts with no equipment, bodyweight strength, mobility, warm-ups, and low-impact cardio options.','keywords'=>'at home workouts, beginner home workout, no equipment workout','type'=>'article');
 if(is_page('nutrition-for-beginners'))$data=array('title'=>'Nutrition for Fitness Beginners | HabitFit','description'=>'Beginner fitness nutrition made simple: balanced plates, hydration, protein, workout snacks, and recovery meals.','keywords'=>'beginner fitness nutrition, nutrition for beginners, healthy eating habits','type'=>'article');
 $url=is_front_page()?home_url('/'): (is_singular()?get_permalink():home_url('/'));
 echo '<meta name="description" content="'.esc_attr($data['description']).'">'.PHP_EOL;
 echo '<meta name="keywords" content="'.esc_attr($data['keywords']).'">'.PHP_EOL;
 echo '<link rel="canonical" href="'.esc_url($url).'">'.PHP_EOL;
 echo '<meta property="og:title" content="'.esc_attr($data['title']).'">'.PHP_EOL;
 echo '<meta property="og:description" content="'.esc_attr($data['description']).'">'.PHP_EOL;
 echo '<meta property="og:type" content="'.esc_attr($data['type']).'">'.PHP_EOL;
 echo '<meta property="og:url" content="'.esc_url($url).'">'.PHP_EOL;
 $schema=array('@context'=>'https://schema.org','@type'=>is_front_page()?'WebSite':'Article','name'=>'HabitFit','headline'=>$data['title'],'url'=>$url,'description'=>$data['description']);
 echo '<script type="application/ld+json">'.wp_json_encode($schema,JSON_UNESCAPED_SLASHES|JSON_HEX_TAG).'</script>'.PHP_EOL;
} add_action('wp_head','habitfit_seo',5);
function habitfit_create_pages(){
 $pages=array(
 'home'=>array('Home','<p>Beginner fitness without the noise.</p>'),
 'beginner-workout-plan'=>array('Beginner Workout Plan','<p>Follow a simple four-week beginner workout plan. Train three days a week, walk on optional days, and keep rest days flexible.</p><h2>Weekly schedule</h2><table><tr><th>Day</th><th>Session</th><th>Time</th></tr><tr><td>Monday</td><td>Full-body strength A</td><td>25–30 min</td></tr><tr><td>Tuesday</td><td>Easy walk or rest</td><td>15–25 min</td></tr><tr><td>Wednesday</td><td>Mobility and core</td><td>20 min</td></tr><tr><td>Thursday</td><td>Rest</td><td>Flexible</td></tr><tr><td>Friday</td><td>Full-body strength B</td><td>25–35 min</td></tr></table><h2>Strength A</h2><ol><li>Chair squat: 2–3 sets of 8–10 reps</li><li>Incline push-up: 2–3 sets of 6–10 reps</li><li>Glute bridge: 2–3 sets of 10–12 reps</li><li>Backpack row: 2 sets of 8 each side</li><li>Dead bug: 2 sets of 6 each side</li></ol><h2>Progression</h2><p>Add reps gradually while keeping movement quality and recovery in view.</p>'),
 'at-home-workouts'=>array('At-Home Workouts','<p>Use bodyweight, a chair, a wall, and a small amount of floor space. Keep early sessions easy enough to repeat.</p><h2>20-minute no-equipment session</h2><ol><li>March in place: 2 minutes</li><li>Sit-to-stand squat: 3 rounds of 8 reps</li><li>Wall push-up: 3 rounds of 8 reps</li><li>Standing hip hinge: 3 rounds of 10 reps</li><li>Bird dog: 2 rounds of 6 each side</li><li>Easy walk: 2 minutes</li></ol><h2>Mobility reset</h2><p>Move slowly through cat-cow, hip flexor stretch, hamstring reach, chest opener, and relaxed breathing.</p><h2>Low-impact cardio</h2><p>Walk, climb stairs slowly, do step taps, or cycle at an easy pace.</p>'),
 'nutrition-for-beginners'=>array('Nutrition for Beginners','<p>Nutrition supports training; it does not have to take over your life. Start with regular meals, enough protein, and a simple plan for busy days.</p><h2>Beginner plate method</h2><p>Build meals around protein, carbohydrates, vegetables or fruit, and a small serving of fat.</p><h2>Easy workout snacks</h2><ul><li>Banana with yogurt</li><li>Toast with eggs</li><li>Oats with milk and berries</li><li>Rice bowl with beans or chicken</li><li>Smoothie with fruit and protein</li></ul><h2>Hydration and recovery</h2><p>Drink water regularly and aim for familiar meals with protein and carbohydrates after training.</p>')
 );
 foreach($pages as $slug=>$page){$existing=get_page_by_path($slug,OBJECT,'page');if(!$existing){$id=wp_insert_post(array('post_type'=>'page','post_status'=>'publish','post_title'=>$page[0],'post_name'=>$slug,'post_content'=>$page[1]),true);if($slug==='home'&&!is_wp_error($id))update_option('page_on_front',(int)$id);}elseif($slug==='home')update_option('page_on_front',(int)$existing->ID);}
 update_option('show_on_front','page');
} add_action('after_switch_theme','habitfit_create_pages');
