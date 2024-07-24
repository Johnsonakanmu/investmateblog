<?php
require_once 'crud_operation.php';
$popularBlogs = listPostsByCaption('Popular');
$trendingBlogs = listPostsByCaption('Trending');
$latestBlogs = listPostsByCaption('Latest');

function generateBlogHTML($blogs) {
    $html = '';

    foreach ($blogs as $blog) {
        $html .= '<div class="post-entry-1 border-bottom">';
        $html .= '<div class="post-meta"><span class="date">' . htmlspecialchars($blog['category']) . '</span> <span class="mx-1">&bullet;</span> <span>' . formatDate($blog['created_at']) . '</span></div>';
        $html .= '<h2 class="mb-2"><a href="single-post.php?id=' . htmlspecialchars($blog['post_id']) . '">' . htmlspecialchars($blog['title']) . '</a></h2>';
        $html .= '<span class="author mb-3 d-block">' . htmlspecialchars($blog['first_name'] . ' ' . $blog['last_name']) . '</span>';
        $html .= '</div>';
    }

    return $html;
}

// Generate HTML content for each category
$popularBlogsHTML = generateBlogHTML($popularBlogs);
$trendingBlogsHTML = generateBlogHTML($trendingBlogs);
$latestBlogsHTML = generateBlogHTML($latestBlogs);

$category =null;
$createdAt = null;
$title = null;
$imagePath = null;
$figcaption = null;
$content = null;
if (isset($_GET['id'])) {
    $postId = $_GET['id'];
   $blogPost = getPostById($postId);

    if ($blogPost) {
        // Blog post exists, display it
        $category = htmlspecialchars($blogPost['category']);
        $createdAt = formatDate($blogPost['created_at']);
        $title = htmlspecialchars($blogPost['title']);
        $imagePath = readFileContent($blogPost['featured_image_url']);
        $figcaption = htmlspecialchars($blogPost['caption']);
        $content = htmlspecialchars($blogPost['content']); // Assume content is stored as HTML
    } else {
        // Blog post not found
        $error = "Blog post not found.";
    }
} else {
    // post_id not set
    $error = "Invalid request.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>InvestmateBlog  - Single Post</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/new-favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <?php include 'head.php'?>
</head>

<body>

  <!-- ======= Header ======= -->
   <?php include 'navbar.php' ?>
  <!-- End Header -->

  <main id="main">

    <section class="single-post-content">
      <div class="container">
        <div class="row">
          <div class="col-md-9 post-content" data-aos="fade-up">

            <!-- ======= Single Post Content ======= -->
            <div class="single-post">
                <?php if (isset($blogPost)): ?>
                    <div class="post-meta"><span class="date"><?php echo $category; ?></span> <span class="mx-1">&bullet;</span> <span><?php echo $createdAt; ?></span></div>
                    <h1 class="mb-5"><?php echo $title; ?></h1>
                    <figure class="my-4">
                        <img src="<?php echo $imagePath; ?>" alt="" class="img-fluid">
                        <figcaption><?php echo $figcaption; ?></figcaption>
                    </figure>
                    <?php echo $content; ?>
                <?php else: ?>
                    <p><?php echo $error; ?></p>
                <?php endif; ?>
            </div><!-- End Single Post Content -->


          </div>
          <div class="col-md-3">
            <!-- ======= Sidebar ======= -->
              <div class="aside-block">

                  <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
                      <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="pills-popular-tab" style="color:#e73667" data-bs-toggle="pill" data-bs-target="#pills-popular" type="button" role="tab" aria-controls="pills-popular" aria-selected="true">Popular</button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-trending-tab" style="color:#e73667" data-bs-toggle="pill" data-bs-target="#pills-trending" type="button" role="tab" aria-controls="pills-trending" aria-selected="false">Trending</button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-latest-tab" style="color:#e73667" data-bs-toggle="pill" data-bs-target="#pills-latest" type="button" role="tab" aria-controls="pills-latest" aria-selected="false">Latest</button>
                      </li>
                  </ul>

                  <div class="tab-content" id="pills-tabContent">
                      <!-- Popular -->
                      <div class="tab-pane fade show active" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">
                          <?php echo $popularBlogsHTML; ?>
                      </div> <!-- End Popular -->

                      <!-- Trending -->
                      <div class="tab-pane fade" id="pills-trending" role="tabpanel" aria-labelledby="pills-trending-tab">
                          <?php echo $trendingBlogsHTML; ?>
                      </div> <!-- End Trending -->

                      <!-- Latest -->
                      <div class="tab-pane fade" id="pills-latest" role="tabpanel" aria-labelledby="pills-latest-tab">
                          <?php echo $latestBlogsHTML; ?>
                      </div> <!-- End Latest -->
                  </div>
              </div>

            <div class="aside-block">
              <h3 class="aside-title" style="color: #e73667">Video</h3>
              <div class="video-post">
                <a href="https://www.youtube.com/watch?v=AiFfDjmd0jU" class="glightbox link-video">
                  <span class="bi-play-fill"></span>
                  <img src="assets/img/post-landscape-5.jpg" alt="" class="img-fluid">
                </a>
              </div>
            </div><!-- End Video -->

          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'footer.php' ?>

  <!-- <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> -->

  <!-- Vendor JS Files -->
  <?php include 'footer_script.php' ?>

  

</body>

</html>