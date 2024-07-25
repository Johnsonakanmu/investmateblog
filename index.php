<?php
require_once 'crud_operation.php';
$blogs=listPosts();
$topBlogs =listPaginatedPosts(7,0);
$firstItem = null;
$remainingPosts = [];
if (!empty($topBlogs)) {
    // Extract the first item
    $firstItem = array_shift($topBlogs);
    $firstItem['formatted_date'] = formatDate($firstItem['created_at']);
    // Remaining items
    $remainingPosts = $topBlogs;
}
$trendings = listPostsByCaption("Trending");

// Initialize an array to hold categories
$categories = [];

// Process each blog to separate by category
foreach ($blogs as $blog) {
    $category = $blog['category'];
    if (!isset($categories[$category])) {
        $categories[$category] = [];
    }
    $categories[$category][] = $blog;
}

// Function to randomly choose a layout
function getRandomLayout($index) {
    // 50% chance for each layout
    return $index % 2 === 0 ? 'layout-1' : 'layout-2';
}
$popularItemsIndex = listPostsByCaptionWithLimit('Trending',4);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>InvestmateBlog  - Index</title>
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

    <!-- ======= Hero Slider Section ======= -->
    <section id="hero-slider" class="hero-slider">
      <div class="container-md" data-aos="fade-in">
        <div class="row">
          <div class="col-12">
            <div class="swiper sliderFeaturedPosts">
              <div class="swiper-wrapper">
                  <?php if (!empty($popularItemsIndex)): ?>
                      <?php foreach ($popularItemsIndex as $item): ?>
                          <div class="swiper-slide">
                              <a href="single-post?id=<?php echo htmlspecialchars($item['post_id']); ?>" class="img-bg d-flex align-items-end" style="background-image: url('<?php echo readFileContent($item['featured_image_url']); ?>');">
                                  <div class="img-bg-inner">
                                      <h2><?php echo htmlspecialchars($item['title']); ?></h2>
                                      <p><?php echo htmlspecialchars($item['content']); ?></p>
                                  </div>
                              </a>
                          </div>
                      <?php endforeach; ?>
                  <?php endif; ?>

              </div>
              <div class="custom-swiper-button-next">
                <span class="bi-chevron-right"></span>
              </div>
              <div class="custom-swiper-button-prev">
                <span class="bi-chevron-left"></span>
              </div>

              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Hero Slider Section -->

    <!-- ======= Post Grid Section ======= -->
    <section id="posts" class="posts">
      <div class="container" data-aos="fade-up">
        <div class="row g-5">
            <div class="col-lg-4">
                <?php if ($firstItem): ?>
                    <div class="post-entry-1 lg">
                        <a href="single-post.php?id=<?php echo $firstItem['post_id']; ?>">
                            <img src="<?php echo readFileContent($firstItem['featured_image_url']); ?>" alt="" class="img-fluid">
                        </a>
                        <div class="post-meta">
                            <span class="date"><?php echo htmlspecialchars($firstItem['category']); ?></span>
                            <span class="mx-1">&bullet;</span>
                            <span><?php echo htmlspecialchars($firstItem['formatted_date']); ?></span>
                        </div>
                        <h2>
                            <a href="single-post.php?id=<?php echo $firstItem['post_id']; ?>">
                                <?php echo htmlspecialchars($firstItem['title']); ?>
                            </a>
                        </h2>
                        <p class="mb-4 d-block">
                            <?php echo htmlspecialchars($firstItem['caption']); ?>
                        </p>
                        <div class="d-flex align-items-center author">
                            <div class="photo">
                                <img src="<?php echo readFileContent($firstItem['featured_image_url']); ?>" alt="" class="img-fluid">
                            </div>
                            <div class="name">
                                <h3 class="m-0 p-0">
                                    <?php echo htmlspecialchars($firstItem['first_name']) . ' ' . htmlspecialchars($firstItem['last_name']); ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

          <div class="col-lg-8">
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="row g-5">
                  <?php if (!empty($remainingPosts)): ?>
                      <?php foreach ($remainingPosts as $post): ?>
                <div class="col-lg-6 border-start custom-border">
<!--                          <div class="col-lg-12">-->
                              <div class="post-entry-1">
                                  <a href="single-post.php?id=<?php echo htmlspecialchars($post['post_id']); ?>">
                                      <img src="<?php echo readFileContent($post['featured_image_url']); ?>" alt="" class="img-fluid">
                                  </a>
                                  <div class="post-meta">
                                      <span class="date"><?php echo htmlspecialchars($post['category']); ?></span>
                                      <span class="mx-1">&bullet;</span>
                                      <span><?php echo formatDate($post['created_at']); ?></span>
                                  </div>
                                  <h2>
                                      <a href="single-post.php?id=<?php echo htmlspecialchars($post['post_id']); ?>">
                                          <?php echo htmlspecialchars($post['title']); ?>
                                      </a>
                                  </h2>
                              </div>
<!--                          </div>-->
                </div>
                      <?php endforeach; ?>
                  <?php else: ?>
                      <!-- Optionally, handle the case where there are no remaining posts -->
                      <p></p>
                  <?php endif; ?>
                </div>
                </div>

              <!-- Trending Section -->
              <div class="col-lg-4">

                <div class="trending">
                  <h3 style="color: #e73667">Trending</h3>
                  <ul class="trending-post">
                      <?php if (!empty($trendings)): ?>
                          <?php foreach ($trendings as $trending): ?>
                              <li>
                                  <a href="single-post.php?id=<?php echo htmlspecialchars($trending['post_id']); ?>">
                                      <h3><?php echo htmlspecialchars($trending['title']); ?></h3>
                                      <span class="author"><?php echo htmlspecialchars($post['first_name'] . ' ' . $post['last_name']); ?></span>
                                  </a>
                              </li>
                          <?php endforeach; ?>
                      <?php endif; ?>
                  </ul>
                </div>

              </div> <!-- End Trending Section -->
            </div>
          </div>

        </div> <!-- End .row -->
      </div>
    </section> <!-- End Post Grid Section -->

    <!-- ======= Culture Category Section ======= -->
      <?php foreach ($categories as $category => $posts): ?>
          <section class="category-section">
              <div class="container" data-aos="fade-up">
                  <div class="section-header d-flex justify-content-between align-items-center mb-5">
                      <h2 style="color: #e73667"><?php echo htmlspecialchars($category); ?></h2>
                      <div><a href="#" class="more" style="color: #e73667">See All <?php echo htmlspecialchars($category); ?></a></div>
                  </div>

                  <div class="row">
                      <div class="col-sm-12">
                          <?php foreach ($posts as $index => $post): ?>
                              <?php if (getRandomLayout($index) === 'layout-1'): ?>
                                  <!-- Layout 1 -->
                                  <div class="post-entry-1 border-bottom">
                                      <a href="single-post.php?id=<?php echo htmlspecialchars($post['post_id']); ?>">
                                          <img src="<?php echo readFileContent($post['featured_image_url']); ?>" alt="" class="img-fluid">
                                      </a>
                                      <div class="post-meta">
                                          <span class="date"><?php echo htmlspecialchars($post['category']); ?></span>
                                          <span class="mx-1">&bullet;</span>
                                          <span><?php echo formatDate($post['created_at']); ?></span>
                                      </div>
                                      <h2 class="mb-2">
                                          <a href="single-post.php?id=<?php echo htmlspecialchars($post['post_id']); ?>">
                                              <?php echo htmlspecialchars($post['title']); ?>
                                          </a>
                                      </h2>
                                      <span class="author mb-3 d-block"><?php echo htmlspecialchars($post['first_name'] . ' ' . $post['last_name']); ?></span>
                                      <p class="mb-4 d-block"><?php echo htmlspecialchars($post['caption']); ?></p>
                                  </div>
                              <?php else: ?>
                                  <!-- Layout 2 -->
                                  <div class="post-entry-1 border-bottom">
                                      <div class="post-meta">
                                          <span class="date"><?php echo htmlspecialchars($post['category']); ?></span>
                                          <span class="mx-1">&bullet;</span>
                                          <span><?php echo formatDate($post['created_at']); ?></span>
                                      </div>
                                      <h2 class="mb-2">
                                          <a href="single-post.php?id=<?php echo htmlspecialchars($post['post_id']); ?>">
                                              <?php echo htmlspecialchars($post['title']); ?>
                                          </a>
                                      </h2>
                                      <span class="author mb-3 d-block"><?php echo htmlspecialchars($post['first_name'] . ' ' . $post['last_name']); ?></span>
                                  </div>
                              <?php endif; ?>
                          <?php endforeach; ?>
                      </div>
                  </div>
              </div>
          </section>
      <?php endforeach; ?>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'footer.php' ?>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php include 'footer_script.php' ?>


  
</body>

</html>