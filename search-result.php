<?php
require_once 'crud_operation.php';
$posts=listPosts();
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>InvestmateBlog  - Search Results</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <?php include 'head.php'?>
</head>

<body>

  <!-- ======= Header ======= -->
   <?php include 'navbar.php' ?>
  <!-- End Header -->

  <main id="main">

    <!-- ======= Search Results ======= -->
    <section id="search-result" class="search-result">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <h3 class="category-title" style="color:#e73667">Search Results</h3>

              <?php if (!empty($posts)): ?>
                  <?php foreach ($posts as $post): ?>
                      <div class="d-md-flex post-entry-2 small-img">
                          <a href="single-post.php?id=<?php echo htmlspecialchars($post['post_id']); ?>" class="me-4 thumbnail">
                              <img src="<?php echo readFileContent($post['featured_image_url']); ?>" alt="" class="img-fluid">
                          </a>
                          <div>
                              <div class="post-meta">
                                  <span class="date"><?php echo htmlspecialchars($post['category']); ?></span>
                                  <span class="mx-1">&bullet;</span>
                                  <span><?php echo formatDate($post['created_at']); ?></span>
                              </div>
                              <h3>
                                  <a href="single-post.php?id=<?php echo htmlspecialchars($post['post_id']); ?>">
                                      <?php echo htmlspecialchars($post['title']); ?>
                                  </a>
                              </h3>
                              <p><?php echo htmlspecialchars($post['caption']); ?></p>
                              <div class="d-flex align-items-center author">
                                  <div class="photo">
                                      <img src="<?php echo readFileContent($post['profile_picture_url']); ?>" alt="" class="img-fluid">
                                  </div>
                                  <div class="name">
                                      <h3 class="m-0 p-0"><?php echo htmlspecialchars($post['first_name'] . ' ' . $post['last_name']); ?></h3>
                                  </div>
                              </div>
                          </div>
                      </div>
                  <?php endforeach; ?>
              <?php else: ?>
                  <p>No posts available.</p>
              <?php endif; ?>


              <!-- Paging -->
            <div class="text-start py-4">
              <div class="custom-pagination">
                <a href="#" class="prev">Prevous</a>
                <a href="#" class="active" style="background:#e73667; color: white">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#" class="next">Next</a>
              </div>
            </div><!-- End Paging -->

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
              <h3 class="aside-title" style="color:#e73667">Video</h3>
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
    </section> <!-- End Search Result -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'footer.php' ?>

  <!-- <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> -->

  <!-- Vendor JS Files -->
  <?php include 'footer_script.php' ?>

  

</body>

</html>