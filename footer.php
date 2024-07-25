<?php
$popularItems = listPostsByCaptionWithLimit('Popular',10);
?>
<footer class="echo-footer-area footer-2" id="footer">
        <div class="container" >
            <div class="echo-row">
                <div class="echo-footer-content-1" >
                    <div class="echo-get-in-tuch">
                        <h4 class="text-capitalize">Get In Touch</h4>
                    </div>
                    <div class="echo-footer-address">
                        <span class="text-capitalize"><i class="fa-regular fa-map"></i> 255 Sheet, New Avanew, NY</span>
                        <span class="text-capitalize"><i class="fa-regular fa-phone"></i> (00) 236 123 456 88</span>
                        <span class="text-capitalize"><i class="fa-sharp fa-regular fa-envelope"></i>
                            info@demomail.com</span>
                        <div class="echo-footer-social-media">
                            <a href="#">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                            <a href="#">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                            <a href="#">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>
                            <a href="#">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                            <a href="#">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="echo-footer-content-2">
                    <div class="echo-get-in-tuch">
                        <h4 class="text-capitalize">Most Popular</h4>
                    </div>
                    <div class="echo-footer-most-popular">
                        <ul class="list-unstyled">
                            <?php if (!empty($popularItems)): ?>
                                <?php foreach ($popularItems as $item): ?>
                                    <li><a href="#"><?php echo htmlspecialchars($item['category']); ?></a></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="echo-footer-content-3">
                    <div class="echo-get-in-tuch">
                        <h4 class="text-capitalize">Help</h4>
                    </div>
                    <div class="echo-footer-help" style="margin-left: 10px">
                        <ul class="list-unstyled">
                            <li><a href="https://investmate.pro/advanced-risk-management/">Advanced Risk Management</a></li>
                            <li><a href="https://investmate.pro/cryptocurrency-market-evaluation/">Cryptocurrency Market Evaluation</a></li>
                            <li><a href="https://investmate.pro/managing-investments/">Investment Management</a></li>
                            <li><a href="https://investmate.pro/advanced-risk-management/">Advance Risk</a></li>
                            <li><a href="https://investmate.pro/privacy-policy/">Privacy Policy</a></li>
                            <li><a href="https://investmate.pro/terms-and-conditions/">Terms and Conditions</a></li>
                            
                        </ul>
                    </div>
                </div>
                <div class="echo-footer-content-4">
                    <div class="echo-get-in-tuch">
                        <h4 class="text-capitalize">Newsletter</h4>
                    </div>
                    <div class="echo-footer-news-text">
                        <p>Register now to get latest updates on promotion & coupons.</p>
                    </div>
                    <div class="echo-subscribe-box-button">
                        <form action="POST">
                            <div class="echo-subscribe-input-fill">
                                <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.8" d="M14.4414 11.6674C14.4402 11.8345 14.3734 11.9944 14.2553 12.1127C14.1371 12.2309 13.9773 12.2979 13.8101 12.2993H2.34541C2.17792 12.2991 2.01736 12.2325 1.89899 12.114C1.78062 11.9955 1.71413 11.8348 1.71413 11.6674V11.0265H13.1687V3.58109L8.07777 8.16291L1.71413 2.43564V1.48109C1.71413 1.31232 1.78118 1.15045 1.90052 1.03111C2.01986 0.911772 2.18172 0.844727 2.3505 0.844727H13.805C13.9738 0.844727 14.1357 0.911772 14.255 1.03111C14.3744 1.15045 14.4414 1.31232 14.4414 1.48109V11.6674ZM3.26304 2.11745L8.07777 6.45109L12.8925 2.11745H3.26304ZM0.441406 8.48109H5.53232V9.75382H0.441406V8.48109ZM0.441406 5.29927H3.62322V6.572H0.441406V5.29927Z" fill="white" />
                                </svg>
                                <input type="email"  placeholder="Enter your email" required>
                            </div>
                            <!-- <div class="echo-footer-area-subscribe-button">
                                <a href="#" class="echo-py-btn-border text-capitalize"  style="background-color: red">subscribe</a>
                            </div> -->
                            <div class="echo-footer-area-subscribe-button">
                               <a href="#" class="echo-py-btn-border text-capitalize" style="background-color: #032836; color: white; transition: background-color 0.3s ease, color 0.3s ease;" 
                                   onmouseover="this.style.backgroundColor='#032836'; this.style.color='white';" 
                                   onmouseout="this.style.backgroundColor='#e73667'; this.style.color='white';">
                                   subscribe
                                 </a>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="echo-footer-copyright-area">
                <div class="copyright-area-inner">
                    <div class="footer-logo"><a href="index.php"><img src="assets/img/new-favicon.png" style="height: 50px"></a></div>
                    <div class="copyright-content">
                        <h5 class="title">            
                          Copyright ©  <strong><span>InvestmateBlog 2024</span></strong>. All Rights Reserved
                        </h5>
                    </div>
                    <div class="select-area">
                        <select name="lang" id="lang">
                            <option value="english">English</option>
                            <option value="bengali">Bengali</option>
                            <option value="arabic">Arabic</option>
                            <option value="hindi">Hindi</option>
                            <option value="urdu">Urdu</option>
                            <option value="french">French</option>
                            <option value="tamil">Tamil</option>
                            <option value="marathi">Marathi</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center" 
    style="bbackground-color: #032836; color: white; transition: background-color 0.3s ease, color 0.3s ease;" 
    onmouseover="this.style.backgroundColor='#032836'; this.style.color='white';" 
     onmouseout="this.style.backgroundColor='#e73667'; this.style.color='white';"
    >
      <i class="bi bi-arrow-up-short"></i>
    </a>
