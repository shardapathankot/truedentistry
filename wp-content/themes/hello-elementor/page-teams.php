
<?php
/*
Template Name: Teams Page
*/
get_header();
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <section class="teams">
            <div class="row_team"> <!-- Start the initial row -->
                <?php
                 $post_id = 699; 
                $args = array(
                    'post_type' => 'teams',
                    'posts_per_page' => -1
                );
                $teams_query = new WP_Query( $args );

                $count = 0;
                while ( $teams_query->have_posts() ) {
                    $teams_query->the_post();
                    if ($count % 3 == 0 && $count != 0) {
                        echo ''; // Close the previous row and start a new row after every 3 teams
                    }
                    ?>
                    <div class="col"> <!-- Start a new column for each team -->
                        <article id="post-<?php the_ID(); ?>" <?php post_class('team'); ?>>
                            <div class="entry-content">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                      <?php
                                    if ( $post_id ) {
                                        if ( get_the_ID() == $post_id ) {
                                        ?>
                                     <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo  get_the_content(); ?></a></h2>
                                     <?php 
                                                }
                                            }
                                            ?>
                                     <?php
                                        // Retrieve and display designation
                                        $designation = get_post_meta( get_the_ID(), '_designation', true );
                                        if ( ! empty( $designation ) ) {
                                            echo '<p> ' . esc_html( $designation ) . '</p>';
                                        }
                                    ?>
                                </header>
                            </div>
                        </article>
                    </div>
                    <?php
                    $count++;
                }
                wp_reset_postdata();

                // Close the final row if the total number of teams is not divisible by 3
                if ($count % 3 != 0) {
                    echo '';
                }
                ?>
            </div> <!-- Close the final row -->
        </section>
    </main>
</div>
<?php get_footer(); ?>