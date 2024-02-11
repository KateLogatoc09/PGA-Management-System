<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
//$routes->get('/admins', 'AdminController::admin');

$routes->get('/login', 'Home::logreg');

$routes->get('/reg', 'Home::reg');
$routes->get('/about', 'Home::ab');
$routes->get('/verify', 'Home::verify');
$routes->get('/forget', 'Home::forget');

$routes->get('/admins', 'AdminController::index');
$routes->get('/cal', 'AdminController::cal');

$routes->get('/addTeacher', 'AdminController::addTeacher');
$routes->get('/teach/(:any)', 'AdminController::teach/$1');
$routes->post('/saveteacher', 'AdminController::save');
$routes->get('/deleteteacher/(:any)', 'AdminController::delete/$1');
$routes->get('/editteacher/(:any)', 'AdminController::edit/$1');
$routes->get('/teacher', 'TeacherController::teacher');
$routes->get('/enroll', 'AdminController::enroll');
$routes->get('/deleteenroll/(:any)', 'AdminController::delete/$1');
$routes->get('/editenroll/(:any)', 'AdminController::edit/$1');

$routes->get('/graph', 'GradeController::index');

$routes->get('/student', 'StudentController::index');


$routes->get('/addenroll', 'EnrollmentController::addenroll');
$routes->get('/enroll/(:any)', 'EnrollmentController::enroll/$1');
$routes->post('/save', 'EnrollmentController::save');
$routes->post('/savefamily', 'EnrollmentController::savefamily');
$routes->post('/saveaddress', 'EnrollmentController::saveaddress');
$routes->post('/saveadmissions', 'EnrollmentController::saveadmissions');
$routes->post('/savesibling', 'EnrollmentController::savesibling');
$routes->post('/saveschool', 'EnrollmentController::saveschool');

$routes->post('/Registering', 'StudentController::register');
$routes->get('/logout', 'Home::Logout');
$routes->post('/LoginAuth', 'Home::LoginAuth');


$routes->get('/li', 'LibraryController::index');
$routes->post('/saveBook', 'LibraryController::saveBook');
$routes->post('/saveBorrowedBook', 'LibraryController::saveBorrowedBook');
$routes->post('/borrowBook', 'LibraryController::borrowBook');
$routes->get('/librarian', 'LibraryController::librarian');
$routes->get('/deleteBorrow/(:any)', 'LibraryController::deleteBorrow/$1');
$routes->get('/editBorrow/(:any)', 'LibraryController::editBorrow/$1');
$routes->get('/deleteBook/(:any)', 'LibraryController::deleteBook/$1');
$routes->get('/editBook/(:any)', 'LibraryController::editBook/$1');
