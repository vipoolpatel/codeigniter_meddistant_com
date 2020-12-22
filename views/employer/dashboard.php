<main>
        <div class="container-fluid">
            <div class="row  ">
                <div class="col-12">
                    <h1>Dashboard</h1>
                    <div class="separator mb-5"></div>
                </div>
                <div class="col-lg-12 col-xl-12">
                   <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="padding:20px;font-size: 16px;font-weight: bold;">

                            <h2 style="margin: 0px;font-weight: bold;">MeddiGlobal Care

        <?php
if (!empty($validate->entrollment_date)) {
	?>
    <a class="btn btn-primary pull-right" style="display: inline-table;float: right;color: #fff;">Member Since <?=date('M-Y', strtotime($validate->entrollment_date))?></a>
<?php
} else {?>
    <a href="<?=base_url()?>entrollment_data" class="btn btn-primary pull-right" style="display: inline-table;float: right;">Join Us for Free, While its Lests</a>
<?php
}
?>

                            </h2>


                            <hr />

                               <p style="font-size: 16px;font-weight: bold;">
                                   In Addition to saving on treatments, your referrals receive 50% on facilitation fees.
                               </p>


                               <p style="font-size: 16px;font-weight: bold;">
                                   Self-Insured employers, business owners, insurers and Brokers; looking to improve offerings to their customers or employees while saving 50-80% on any given major medical procedure?
                               </p>


                               <p style="font-size: 16px;font-weight: bold;">
                               Meddistant is here to help you reduce costs and attract customers while maintaining high quality standards and medical services.We help customers navigate the global and our growing US markets.
                                </p>
                                <p><strong style="font-size: 20px;">All that is Free to all users</strong></p>
                                <ul>
                                    <li>Transparent process where customer receives more than one quote from various hospitals.</li>
                                    <li>All hospitals or clinics we partner with are JCI accredited to assure high quality comparable with top US or European hospitals.</li>
                                    <li>Our list of affiliated hospitals is growing from Turkey to Mexico and more.</li>
                                    <li>Over 300 medical procedures are covered by affiliated hospitals</li>
                                    <li>Complete patient privacy and data management through technology and compliance.</li>

                                </ul>
                                <p><strong style="font-size: 20px;">Our medical concierge Services:</strong></p>
                                <ul>
                                    <li>Dedicated personal assistance</li>
                                    <li>Our Staff and our semi-automated matching platform, help customer compare costs and service providers globally</li>
                                    <li>Treatment booking and aftercare support</li>
                                    <li>Travel and accommodation logistics and booking, including local transportation</li>
                                    <li>Translation and interpretation during appointments</li>
                                </ul>
                                <div class="col-md-2">
                                    <a href="<?=base_url()?>referrals/add" class="btn btn-primary">Start Referring Today</a>
                                    <br /><br />
                                </div>

                                <div style="clear:both;"></div>

                                <p><strong style="font-size: 20px;">How it Works</strong></p>
                                <ul>
                                    <li>As an employer or Insurer, you can immediately start referring customers after enrolling. Your referrals will automatically receive perks and possible discounts based on membership.</li>
                                    <li>Your referrals fill out request for quote and register.</li>
                                    <li>Within days, they receive multiple offerings from up to 5 hospitals or clinics in a selected destination country.</li>
                                    <li>Customer choose then chooses one and checks out, paying a partial or full payment prior to departure.</li>
                                    <li>We can assist and book all other flight and hotel accommodations if customer asks us.</li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>