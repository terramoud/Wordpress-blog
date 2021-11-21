<?php 
/*
Template Name: About me
*/
?>

<?php get_header(); ?>

  <div class="resumes">
    <section class="resumes_wrapper"> 
      <h2 class="content_header">
        <?php the_title(); ?>
      </h2>
      <div class="resume_article">
        <div class="resumes_article__header">
          <span class="resumes-avatar-wrapper"><?= get_the_post_thumbnail( $post->ID, 'full', array('class' => 'resumes__avatar') ); ?></span>
          <ul class="list-data-my">
            <?php
              $lang_slug = function_exists('pll_current_language') ? pll_current_language() : "en";  
              $page_title = 'footer_' . $lang_slug;
              $current_footer_page = get_page_by_title($page_title);
              
              if  (get_field('autor_blog', $current_footer_page) ) echo ('<li><i class="fa ' . get_field('autor_blog_icon', $current_footer_page) . '" aria-hidden="true"></i><span class="data-my name" title="'. get_field('autor_blog', $current_footer_page) .'">' . get_field('autor_blog', $current_footer_page) . '</span></li>');

              $field_names = array('autor_blog','autor_blog_icon','mobile_number', 'mobile-icon', 'email', 'mobile_icon_email', 'rss', 'rss-icon');

              for ($i=2; $i < count($field_names); $i=$i+2) { 

                if (get_field($field_names[$i], $current_footer_page)) echo ('<li><i class="fa ' . get_field($field_names[$i+1], $current_footer_page) . '" aria-hidden="true"></i><span class="data-my" title="'. get_field($field_names[$i], $current_footer_page) .'">' . get_field($field_names[$i], $current_footer_page) . '</span></li>');

              }

              wp_nav_menu( array(
                'theme_location'  => 'footer_contact-me',
                'container' => '',
                'menu_class'      => '', 
                'depth'           => 1,
                'items_wrap' => '%3$s',
                'walker'          => new about_me_custom_Walker_Nav_Menu,
              ) ); 
            ?>
          </ul>
        </div>

        <div class="resumes-description"> 
          <article class="my-projects">
            <?php the_content(); ?>
            <h2 class="my-projects_header"><?php the_field('header_group_project'); ?></h2>
            <ul class="my-projects_developed">
              <?php if( have_rows('subgroup_projects') ):  
                $subgroup_projects = get_field('subgroup_projects');  
                $add_project = 1;
                ?> 
                <?php foreach ($subgroup_projects as $value) : ?>
                  <?php if ($value['name_project'] && $add_project): ?>
                    <li>
                      <h3 class="my-projects_head"><?= $value['name_project'] ?></h3>
                      <span class="my-projects_link__font-bold">Link: </span><a href="<?= $value['link'] ?>" class="my-projects_link"><?= $value['link'] ?></a>
                      <span class="my-projects_role"><b>Role:</b> <?= $value['role'] ?></span>
                      <p class="my-projects_description"><?= $value['project_description'] ?></p>
                    </li>
                  <?php else: break; ?>
                  <?php endif; ?>
                  <?php $add_project = $value['add_project'] ?: 0; ?>
                <?php endforeach; ?>
              <?php else : ?>
                <?php the_field('no_project'); ?>
              <?php endif; ?>
            </ul>
          </article>
          
          <article class="work">
            <h2 class="work_head"><?php the_field('header_history_work'); ?></h2>
            <ul class="work_list">
              <?php if( have_rows('subgroup_history_work') ): ?>
                <?php 
                  $subgroup_history_work = get_field('subgroup_history_work');  
                  $add_old_work = 1;
                ?> 
                <?php foreach ($subgroup_history_work as $value) : ?>
                  <?php if ($value['time-organization'] && $add_old_work): ?>
                    <li class="work_list__item">
                      <h4 class="work_list__item-header"><?= $value['time-organization'] ?></h4>
                      <span class="work_list__item-description-job"><?= $value['position'] ?></span>
                    </li>
                  <?php else: break; ?>
                  <?php endif; ?>
                  <?php $add_old_work = $value['add_old_work'] ?: 0; ?>
                <?php endforeach; ?>
              <?php else : ?>
                <?php the_field('no_worked'); ?>
              <?php endif; ?>
            </ul>
          </article>

          <article id="skills" class="skills">
            <h2 class="skills_header"><?php the_field('header_technical_skills'); ?></h2>
            <ul class="skills_list">
              <?php if( have_rows('subgroup_skill') ): ?>
                <?php 
                  $subgroup_skill = get_field('subgroup_skill');  
                  $add_skill = 1;
                ?> 
                <?php foreach ($subgroup_skill as $value) : ?>
                  <?php if ($value['description_skill'] && $add_skill): ?>
                    <li class="skills_list__item"><?= $value['description_skill'] ?></li>
                  <?php else: break; ?>
                  <?php endif; ?>
                  <?php $add_skill = $value['add_skill'] ?: 0; ?>
                <?php endforeach; ?>
              <?php else : ?>
                <?php the_field('not_skills'); ?>
              <?php endif; ?>
            </ul>
          </article>

          <?php if( get_field('header_personality_traits') ): ?>
            <article class="skills">
              <h2 class="skills_header"><?php the_field('header_personality_traits'); ?></h2>
              <ul class="skills_list">
              <?php if( have_rows('subgroup_personality_traits') ): ?>
                <?php 
                  $subgroup_personality_traits = get_field('subgroup_personality_traits');  
                  $add_personality_trait = 1;
                ?> 
                <?php foreach ($subgroup_personality_traits as $value) : ?>
                  <?php if ($value['description_personality_trait'] && $add_personality_trait): ?>
                    <li class="skills_list__item"><?= $value['description_personality_trait'] ?></li>
                  <?php else: break; ?>
                  <?php endif; ?>
                  <?php $add_personality_trait = $value['add_personality_trait'] ?: 0; ?>
                <?php endforeach; ?>
              <?php endif; ?>
              </ul>
            </article>
          <?php endif; ?>

          <?php if( get_field('header_personal_interests') ): ?>
            <article class="interes">
              <h2 class="interes_header"><?php the_field('header_personal_interests'); ?></h2>
              <ul class="interes_list">
              <?php if( have_rows('subgroup_personal_interests') ): ?>
                <?php 
                  $subgroup_personal_interests = get_field('subgroup_personal_interests');  
                  $add_personal_interest = 1;
                ?> 
                <?php foreach ($subgroup_personal_interests as $value) : ?>
                  <?php if ($value['description_personal_interest'] && $add_personal_interest): ?>
                    <li class="interes_list__item"><?= $value['description_personal_interest'] ?></li>
                  <?php else: break; ?>
                  <?php endif; ?>
                  <?php $add_personal_interest = $value['add_personal_interest'] ?: 0; ?>
                <?php endforeach; ?>
              <?php endif; ?>
              </ul>
            </article>
          <?php endif; ?>
        </div>

      </div>
      <!--/.article-->
    </section>
    <!--/.unfinished-blog-post-->
  </div>

</main>

<?php get_footer(); ?>