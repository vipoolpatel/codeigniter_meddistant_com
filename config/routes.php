<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
 */
//user side route

$route['about/why-meddistant'] = 'about/why_meddistant';
$route['about/our-mission'] = 'about/our_mission';
$route['about/med-treatment'] = 'about/med_treatment';
$route['about/privacy-policy'] = 'about/privacy_policy';

$route['treatment/hair-transplant'] = 'treatment/hair_transplant';
$route['treatment/dental-implant'] = 'treatment/dental_implant';
$route['treatment/knee-surgery'] = 'treatment/knee_surgery';

$route['top-hospitals'] = 'welcome/top_hospitals';
$route['top-doctors'] = 'welcome/top_doctors';
$route['how-it-works'] = 'welcome/how_it_works';
$route['financing'] = 'welcome/financing';
$route['contact'] = 'welcome/contact';
$route['schedule-call'] = 'welcome/schedule_call';
$route['quote-process'] = 'welcome/quote_process';

$route['login/recover-password'] = 'login/recover_password';

$route['blog/pitfalls-to-avoid-while-availing-medical-tourism'] = 'blog/blog_1';
$route['blog/5-significant-reasons-turkey-is-becoming-hub-of-medical-tourism'] = 'blog/blog_2';
$route['blog/turkey-safer-medical-tourism-destination-as-compared-to-the-usa-and-europe'] = 'blog/blog_3';
$route['blog/guide-on-after-treatment-medical-travel-you-can-always-rely-on'] = 'blog/blog_4';

// seo

$route['admin'] = 'admin/dashboard';
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
