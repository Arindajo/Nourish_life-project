<?php
/* Template Name: Contact Page */
get_header(); 
?>

<?php
if( isset($_POST['cf_submit']) ) {

    $name = sanitize_text_field($_POST['cf_name']);
    $email = sanitize_email($_POST['cf_email']);
    $message = sanitize_textarea_field($_POST['cf_message']);

    $to = get_bloginfo('admin_email'); // Sends to site admin email
    $subject = "New Contact Message from $name";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = ['Content-Type: text/plain; charset=UTF-8'];

    $sent = wp_mail($to, $subject, $body, $headers);

    if($sent){
        echo '<p style="color:green;">Thank you! Your message has been sent.</p>';
    } else {
        echo '<p style="color:red;">Oops! Something went wrong. Please try again later.</p>';
    }
}
?>

<section class="contact-page">
    <div class="container">
        <h2><?php the_field('contact_heading'); ?></h2>
        <p><?php the_field('contact_desc'); ?></p>

        <form method="post" action="">
    <label for="name">Name:</label>
    <input type="text" id="name" name="cf_name" placeholder="<?php the_field('name_placeholder'); ?>" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="cf_email" placeholder="<?php the_field('email_placeholder'); ?>" required>

    <label for="message">Message:</label>
    <textarea id="message" name="cf_message" rows="5" placeholder="<?php the_field('message_placeholder'); ?>" required></textarea>

    <button type="submit" class="btn" name="cf_submit"><?php the_field('button_text'); ?></button>
</form>

    </div>
</section>

<?php get_footer(); ?>
