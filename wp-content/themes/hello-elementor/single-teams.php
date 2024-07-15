<style>
    .single_serviceContent h1 {
        padding-top: 10px;
        padding-bottom: 10px;
        color: #CC5500;
        font-family: "Poppins", Sans-serif;
        font-weight: 600;
        text-align: center;
        font-size: 2rem;
        margin: 1rem 0 1rem;
    }
    .single_serviceContent .service_image {
        width: 100%;
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        object-fit: cover;
    }
    .single_serviceContent .service_image {
        width: 100%;
        height: 400px;
        display: flex;
        align-items: baseline;
        justify-content: center;
        overflow: hidden;
        border-radius: 9px;
        background-color: #eeeeee3b;
        margin-bottom: 20px;
    }
    .single_serviceContent .service_image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    .single_serviceContent .doctor_designation {
        margin-top: 15px;
        color: #CC5500;
        font-family: "Poppins", Sans-serif;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 10px;
        margin-top: 10px;
    }
    .single_serviceContent p {
        font-family: "Poppins", Sans-serif;
        font-weight: 400;
        line-height: 33px;
        color: #7a7a7a;
    }
    
    @media screen and (max-width:580px) {
        .single_serviceContent .service_image {
            height: auto;
        }
        .single_serviceContent h1 {
            font-size: 17px;
        }
        .single_serviceContent .doctor_discription {
            font-size: 12px;
            text-align: center;
            line-height: 25px;
        }
    }
</style>
<?php
get_header();
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header single_serviceHeader">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>
            <div class="entry-content single_serviceContent">
              <h1 class=""><?php the_title(); ?></h1>
              <div class="service_image">
                 <?php the_post_thumbnail(); ?>
                 </div>
                 <?php
                // Retrieve and display designation
                $designation = get_post_meta( get_the_ID(), '_designation', true );
                if ( ! empty( $designation ) ) {
                    echo '<p class="doctor_designation">' . esc_html( $designation ) . '</p>';
                }
                ?>
                <?php the_content(); ?>
            </div>
        </article>
    </main>
</div>
<?php get_footer(); ?>
