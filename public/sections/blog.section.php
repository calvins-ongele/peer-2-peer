  <?php 
  
  foreach ($blogData??[] as $blog) { ?>
      <!-- Post item Start -->
      <div class="col-lg-4 col-md-6 col-12">
          <div class="post-item box-border-linear-gradient wow fadeInUp" data-wow-delay="0.75s">
              <div class="post-img">
                  <a href="/blog/<?= $blog['blog_slug'] ?>"><img src="/public/assets/uploads/<?= $blog['blog_image'] ?>" alt=""></a>
              </div>

              <div class="post-content">
                  <div class="post-header">
                      <div class="post-meta">
                          <ul>
                              <li><i class="fa-solid fa-calendar-days"></i> <?= date('d M, Y', strtotime($blog['blog_created_at'])) ?></li>
                          </ul>
                      </div>

                      <h2><a href="/blog/<?= $blog['blog_slug'] ?>"><?= $blog['blog_title'] ?></a></h2>
                  </div>
              </div>
          </div>
      </div>
      <!-- Post item End -->
  <?php } ?>