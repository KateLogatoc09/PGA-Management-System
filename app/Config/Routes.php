<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 //FIRST PAGE
$routes->get('/', 'Home::index');

//PAGES BEFORE LOGIN
$routes->get('/login', 'Home::logreg', ['filter' => 'loggedin']);
$routes->get('/reg', 'Home::reg', ['filter' => 'loggedin']);
$routes->get('/about', 'Home::ab');
$routes->get('/verify', 'Home::verify', ['filter' => 'loggedin']);
$routes->get('/verifying', 'Home::verifying', ['filter' => 'verify']);
$routes->get('/forgot', 'Home::forgot', ['filter' => 'loggedin']);
$routes->get('/password', 'Home::password', ['filter' => 'password']);

//CONTACT
$routes->post('/ask_now', 'Mailing::ask');
$routes->get('/notif', 'Mailing::notif');

//GENERAL
$routes->get('/general', 'GeneralController::general', ['filter' => 'isloggedin']);
$routes->get('/applyStudent', 'GeneralController::applyStudent', ['filter' => 'isloggedin']);
$routes->get('/applyParent', 'GeneralController::applyParent', ['filter' => 'isloggedin']);
$routes->get('/applyConfirm', 'GeneralController::applyConfirm', ['filter' => 'isloggedin']);
$routes->get('/notification', 'GeneralController::notification', ['filter' => 'isloggedin']);
$routes->post('/apply_st', 'GeneralController::apply_st', ['filter' => 'isloggedin']);
$routes->post('/apply_pr', 'GeneralController::apply_pr', ['filter' => 'isloggedin']);

//ATTENDANCE
$routes->post('/time_in', 'Attendance::time_in', ['filter' => 'guard']);
$routes->post('/time_out', 'Attendance::time_out', ['filter' => 'guard']);
$routes->get('/attendance_in', 'Attendance::attendance_in', ['filter' => 'guard']);
$routes->get('/attendance_out', 'Attendance::attendance_out', ['filter' => 'guard']);

//ADMIN FIRSTPAGE
$routes->get('/admins', 'AdminController::index', ['filter' => 'admin']);

//ADMIN MANAGE ACCOUNTS
$routes->post('/saveAccount', 'AdminController::saveAccount', ['filter' => 'admin']);
$routes->get('/deleteAccount/(:any)', 'AdminController::deleteAccount/$1', ['filter' => 'admin']);
$routes->get('/editAccount/(:any)', 'AdminController::editAccount/$1', ['filter' => 'admin']);

$routes->get('/announce', 'AdminController::announce', ['filter' => 'admin']);

//ADMIN TEACHER
$routes->get('/addTeacher', 'AdminController::addTeacher', ['filter' => 'admin']);
$routes->get('/searchAccount', 'AdminController::searchAccount', ['filter' => 'admin']);
$routes->get('/searchTeacher', 'AdminController::searchTeacher', ['filter' => 'admin']);
$routes->get('/teach/(:any)', 'AdminController::teach/$1', ['filter' => 'admin']);
$routes->post('/saveteacher', 'AdminController::save', ['filter' => 'admin']);
$routes->get('/deleteteacher/(:any)', 'AdminController::delete/$1', ['filter' => 'admin']);
$routes->get('/editteacher/(:any)', 'AdminController::edit/$1', ['filter' => 'admin']);

//TEACHER
$routes->get('/teacher', 'TeacherController::teacher', ['filter' => 'teacher']);
$routes->get('/searchGrade', 'TeacherController::searchGrade', ['filter' => 'teacher']);
$routes->post('/teacher_qr', 'TeacherController::simple_qr', ['filter' => 'teacher']);
$routes->post('/teachersave', 'TeacherController::teachersave', ['filter' => 'teacher']);
$routes->get('/teacherinfo', 'TeacherController::teacherinfo', ['filter' => 'teacher']);
$routes->get('/grade', 'TeacherController::grade', ['filter' => 'teacher']);
$routes->post('/saveGrade', 'TeacherController::saveGrade', ['filter' => 'teacher']);
$routes->get('/deleteGrade/(:any)', 'TeacherController::deleteGrade/$1', ['filter' => 'teacher']);
$routes->get('/editGrade/(:any)', 'TeacherController::editGrade/$1', ['filter' => 'teacher']);
$routes->post('/teacher_qr', 'TeacherController::teacher_qr', ['filter' => 'teacher']);

//ADMIN ENROLL
$routes->get('/enroll', 'AdminController::enroll', ['filter' => 'admin']);
$routes->get('/deleteenroll/(:any)', 'AdminController::delete/$1', ['filter' => 'admin']);
$routes->get('/editenroll/(:any)', 'AdminController::edit/$1', ['filter' => 'admin']);

//STUDENT GRADE
$routes->get('/graph', 'GradeController::index', ['filter' => 'student']);

//STUDENT PROFILE
$routes->get('/student', 'StudentController::index', ['filter' => 'student']);
$routes->post('/generate', 'StudentController::simple_qr', ['filter' => 'student']);
$routes->get('/studentlibrary', 'StudentController::studentlibrary', ['filter' => 'student']);
$routes->get('/searchLibrary', 'StudentController::searchLibrary', ['filter' => 'student']);
$routes->post('/studentborrowBook', 'StudentController::studentborrowBook', ['filter' => 'student']);

//STUDENT ENROLL
$routes->get('/learner', 'EnrollmentController::learner', ['filter' => 'student']);
$routes->get('/address', 'EnrollmentController::address', ['filter' => 'student']);
$routes->get('/admission', 'EnrollmentController::admission', ['filter' => 'student']);
$routes->get('/family', 'EnrollmentController::family', ['filter' => 'student']);
$routes->get('/sibling', 'EnrollmentController::sibling', ['filter' => 'student']);
$routes->get('/school', 'EnrollmentController::school', ['filter' => 'student']);
$routes->get('/confirm', 'EnrollmentController::confirm', ['filter' => 'student']);
$routes->get('/enroll/(:any)', 'EnrollmentController::enroll/$1', ['filter' => 'student']);
$routes->post('/save', 'EnrollmentController::save', ['filter' => 'student']);
$routes->post('/savefamily', 'EnrollmentController::savefamily', ['filter' => 'student']);
$routes->post('/saveaddress', 'EnrollmentController::saveaddress', ['filter' => 'student']);
$routes->post('/saveadmissions', 'EnrollmentController::saveadmissions', ['filter' => 'student']);
$routes->post('/savesibling', 'EnrollmentController::savesibling', ['filter' => 'student']);
$routes->post('/saveschool', 'EnrollmentController::saveschool', ['filter' => 'student']);

//AUTHENTICATION
$routes->post('/registering', 'Authentication::Register', ['filter' => 'loggedin']);
$routes->get('/logout', 'Authentication::Logout');
$routes->post('/authenticate', 'Authentication::LoginAuth', ['filter' => 'loggedin']);

//VERIFICATION
$routes->post('/sending', 'Authentication::sending', ['filter' => 'loggedin']);
$routes->post('/resend', 'Authentication::resend', ['filter' => 'loggedin']);
$routes->post('/checking', 'Authentication::checking', ['filter' => 'loggedin']);
$routes->post('/recovery', 'Authentication::recovery', ['filter' => 'loggedin']);
$routes->post('/recovering', 'Authentication::recovering', ['filter' => 'loggedin']);

//LIBRARIAN
$routes->post('/saveBook', 'LibraryController::saveBook', ['filter' => 'librarian']);
$routes->post('/saveBorrowedBook', 'LibraryController::saveBorrowedBook', ['filter' => 'librarian']);
$routes->get('/searchBorrower', 'LibraryController::searchBorrower', ['filter' => 'librarian']);
$routes->get('/searchBook', 'LibraryController::searchBook', ['filter' => 'librarian']);
$routes->get('/librarian', 'LibraryController::librarian', ['filter' => 'librarian']);
$routes->get('/deleteBorrow/(:any)', 'LibraryController::deleteBorrow/$1', ['filter' => 'librarian']);
$routes->get('/editBorrow/(:any)', 'LibraryController::editBorrow/$1', ['filter' => 'librarian']);
$routes->get('/deleteBook/(:any)', 'LibraryController::deleteBook/$1', ['filter' => 'librarian']);
$routes->get('/editBook/(:any)', 'LibraryController::editBook/$1', ['filter' => 'librarian']);
$routes->get('/books', 'LibraryController::books', ['filter' => 'librarian']);
$routes->get('/borrowers', 'LibraryController::borrowers', ['filter' => 'librarian']);
$routes->get('/textbooks', 'LibraryController::textbooks', ['filter' => 'librarian']);
$routes->get('/searchShelf1', 'LibraryController::searchShelf1', ['filter' => 'librarian']);
$routes->get('/searchShelf2', 'LibraryController::searchShelf2', ['filter' => 'librarian']);
$routes->get('/fiction_storybook', 'LibraryController::fiction_storybook', ['filter' => 'librarian']);
$routes->get('/searchShelf3', 'LibraryController::searchShelf3', ['filter' => 'librarian']);
$routes->get('/searchShelf6', 'LibraryController::searchShelf6', ['filter' => 'librarian']);
$routes->get('/reference_filipiniana', 'LibraryController::reference_filipiniana', ['filter' => 'librarian']);
$routes->get('/searchShelf4', 'LibraryController::searchShelf4', ['filter' => 'librarian']);
$routes->get('/searchShelf10', 'LibraryController::searchShelf10', ['filter' => 'librarian']);
$routes->get('/reference_filipiniana2', 'LibraryController::reference_filipiniana2', ['filter' => 'librarian']);
$routes->get('/searchShelf11', 'LibraryController::searchShelf11', ['filter' => 'librarian']);
$routes->get('/searchShelf12', 'LibraryController::searchShelf12', ['filter' => 'librarian']);
$routes->get('/reference_filipiniana3', 'LibraryController::reference_filipiniana3', ['filter' => 'librarian']);
$routes->get('/searchShelf13', 'LibraryController::searchShelf13', ['filter' => 'librarian']);
$routes->get('/searchShelf14', 'LibraryController::searchShelf14', ['filter' => 'librarian']);
$routes->get('/multiple_copies', 'LibraryController::multiple_copies', ['filter' => 'librarian']);
$routes->get('/multiple_copies2', 'LibraryController::multiple_copies2', ['filter' => 'librarian']);
$routes->get('/searchShelf5', 'LibraryController::searchShelf5', ['filter' => 'librarian']);
$routes->get('/searchShelf7', 'LibraryController::searchShelf7', ['filter' => 'librarian']);
$routes->get('/searchShelf8', 'LibraryController::searchShelf8', ['filter' => 'librarian']);
$routes->get('/searchShelf9', 'LibraryController::searchShelf9', ['filter' => 'librarian']);
$routes->get('/teacher_references', 'LibraryController::teacher_references', ['filter' => 'librarian']);
$routes->get('/searchShelf15', 'LibraryController::searchShelf15', ['filter' => 'librarian']);
$routes->get('/searchShelf16', 'LibraryController::searchShelf16', ['filter' => 'librarian']);
$routes->get('/other_textbooks', 'LibraryController::other_textbooks', ['filter' => 'librarian']);
$routes->get('/searchShelf17', 'LibraryController::searchShelf17', ['filter' => 'librarian']);
$routes->get('/searchShelf18', 'LibraryController::searchShelf18', ['filter' => 'librarian']);

//PARENTS
$routes->get('/parent', 'ParentController::parent', ['filter' => 'parents']);

//REGISTRAR
$routes->get('/registrar', 'RegistrarController::registrar', ['filter' => 'registrar']);
$routes->get('/reggrade', 'RegistrarController::reggrade', ['filter' => 'registrar']);
$routes->get('/searchAppli', 'RegistrarController::searchAppli', ['filter' => 'registrar']);
$routes->get('/searchSection', 'RegistrarController::searchSection', ['filter' => 'registrar']);
$routes->get('/searchSubject', 'RegistrarController::searchSubject', ['filter' => 'registrar']);
$routes->get('/searchStudgrade', 'RegistrarController::searchStudgrade', ['filter' => 'registrar']);
$routes->get('/registerstudent', 'RegistrarController::registerstudent', ['filter' => 'registrar']);
$routes->post('/regSaveLearner', 'RegistrarController::regSaveLearner', ['filter' => 'registrar']);
$routes->get('/regDeleteLearner/(:any)', 'RegistrarController::regDeleteLearner/$1', ['filter' => 'registrar']);
$routes->get('/regEditLearner/(:any)', 'RegistrarController::regEditLearner/$1', ['filter' => 'registrar']);
$routes->get('/regfam', 'RegistrarController::regfam', ['filter' => 'registrar']);
$routes->post('/regSavefamily', 'RegistrarController::regSavefamily', ['filter' => 'registrar']);
$routes->get('/regDeletefamily/(:any)', 'RegistrarController::regDeletefamily/$1', ['filter' => 'registrar']);
$routes->get('/regEditfamily/(:any)', 'RegistrarController::regEditfamily/$1', ['filter' => 'registrar']);
$routes->get('/regaddress', 'RegistrarController::regaddress', ['filter' => 'registrar']);
$routes->post('/regSaveaddress', 'RegistrarController::regSaveaddress', ['filter' => 'registrar']);
$routes->get('/regDeleteaddress/(:any)', 'RegistrarController::regDeleteaddress/$1', ['filter' => 'registrar']);
$routes->get('/regEditaddress/(:any)', 'RegistrarController::regEditaddress/$1', ['filter' => 'registrar']);
$routes->get('/regsibling', 'RegistrarController::regsibling', ['filter' => 'registrar']);
$routes->post('/regSavesibling', 'RegistrarController::regSavesibling', ['filter' => 'registrar']);
$routes->get('/regDeletesibling/(:any)', 'RegistrarController::regDeletesibling/$1', ['filter' => 'registrar']);
$routes->get('/regEditsibling/(:any)', 'RegistrarController::regEditsibling/$1', ['filter' => 'registrar']);
$routes->get('/regschool', 'RegistrarController::regschool', ['filter' => 'registrar']);
$routes->post('/regSaveschool', 'RegistrarController::regSaveschool', ['filter' => 'registrar']);
$routes->get('/regDeleteschool/(:any)', 'RegistrarController::regDeleteschool/$1', ['filter' => 'registrar']);
$routes->get('/regEditschool/(:any)', 'RegistrarController::regEditschool/$1', ['filter' => 'registrar']);
$routes->get('/regadmissions', 'RegistrarController::regadmissions', ['filter' => 'registrar']);
$routes->post('/regSaveadmissions', 'RegistrarController::regSaveadmissions', ['filter' => 'registrar']);
$routes->get('/regDeleteadmissions/(:any)', 'RegistrarController::regDeleteadmissions/$1', ['filter' => 'registrar']);
$routes->get('/regEditadmissions/(:any)', 'RegistrarController::regEditadmissions/$1', ['filter' => 'registrar']);
$routes->get('/application', 'RegistrarController::application', ['filter' => 'registrar']);
$routes->get('/editApplication/(:any)', 'RegistrarController::editApplication/$1', ['filter' => 'registrar']);
$routes->post('/saveApplication', 'RegistrarController::saveApplication', ['filter' => 'registrar']);
$routes->get('/deleteApplication/(:any)', 'RegistrarController::deleteApplication/$1', ['filter' => 'registrar']);

//REGISTRAR MAIL
$routes->get('/email', 'RegistrarController::mail', ['filter' => 'registrar']);
$routes->post('/send', 'RegistrarController::send', ['filter' => 'registrar']);

//REGISTRAR ACADEMIC INFO
$routes->get('/sections', 'RegistrarController::sections', ['filter' => 'registrar']);
$routes->post('/saveSection', 'RegistrarController::saveSection', ['filter' => 'registrar']);
$routes->get('/deleteSection/(:any)', 'RegistrarController::deleteSection/$1', ['filter' => 'registrar']);
$routes->get('/editSection/(:any)', 'RegistrarController::editSection/$1', ['filter' => 'registrar']);
$routes->get('/subjects', 'RegistrarController::subjects', ['filter' => 'registrar']);
$routes->post('/saveSubject', 'RegistrarController::saveSubject', ['filter' => 'registrar']);
$routes->get('/deleteSubject/(:any)', 'RegistrarController::deleteSubject/$1', ['filter' => 'registrar']);
$routes->get('/editSubject/(:any)', 'RegistrarController::editSubject/$1', ['filter' => 'registrar']);

//REGISTRAR ALUMNI
$routes->get('/alumni', 'RegistrarController::alumni', ['filter' => 'registrar']);
$routes->post('/saveAlumni', 'RegistrarController::saveAlumni', ['filter' => 'registrar']);
$routes->get('/deleteAlumni/(:any)', 'RegistrarController::deleteAlumni/$1', ['filter' => 'registrar']);
$routes->get('/editAlumni/(:any)', 'RegistrarController::editAlumni/$1', ['filter' => 'registrar']);

//DAC
$routes->get('/DAC', 'DACController::DAC', ['filter' => 'DAC']);

//IAC
$routes->get('/IAC', 'IACController::IAC', ['filter' => 'IAC']);

//SAC
$routes->get('/SAC', 'SACController::SAC', ['filter' => 'SAC']);

//AAC
$routes->get('/AAC', 'AACController::AAC', ['filter' => 'AAC']);
$routes->get('/aacsections', 'AACController::aacsections', ['filter' => 'AAC']);
$routes->get('/searchAacsection', 'AACController::searchAacsection', ['filter' => 'AAC']);
$routes->get('/searchAacsubject', 'AACController::searchAacsubject', ['filter' => 'AAC']);
$routes->post('/aacsaveSection', 'AACController::aacsaveSection', ['filter' => 'AAC']);
$routes->get('/aacdeleteSection/(:any)', 'AACController::aacdeleteSection/$1', ['filter' => 'AAC']);
$routes->get('/aaceditSection/(:any)', 'AACController::aaceditSection/$1', ['filter' => 'AAC']);
$routes->get('/aacsubjects', 'AACController::aacsubjects', ['filter' => 'AAC']);
$routes->post('/aacsaveSubject', 'AACController::aacsaveSubject', ['filter' => 'AAC']);
$routes->get('/aacdeleteSubject/(:any)', 'AACController::aacdeleteSubject/$1', ['filter' => 'AAC']);
$routes->get('/aaceditSubject/(:any)', 'AACController::aaceditSubject/$1', ['filter' => 'AAC']);

//AAC sections
$routes->get('/St_Joseph_Husband_of_Mary', 'AACController::St_Joseph_Husband_of_Mary', ['filter' => 'AAC']);
$routes->get('/St_Perpetua_and_Felicity', 'AACController::St_Perpetua_and_Felicity', ['filter' => 'AAC']);
$routes->get('/St_Louise_de_Marillac', 'AACController::St_Louise_de_Marillac', ['filter' => 'AAC']);
$routes->get('/St_Dominic_Savio', 'AACController::St_Dominic_Savio', ['filter' => 'AAC']);
$routes->get('/St_Pedro_Calungsod', 'AACController::St_Pedro_Calungsod', ['filter' => 'AAC']);
$routes->get('/St_Gemma_Galgani', 'AACController::St_Gemma_Galgani', ['filter' => 'AAC']);
$routes->get('/St_Catherine_of_Siena', 'AACController::St_Catherine_of_Siena', ['filter' => 'AAC']);
$routes->get('/St_Lawrence_of_Manila', 'AACController::St_Lawrence_of_Manila', ['filter' => 'AAC']);
$routes->get('/St_Pio_of_Pietrelcina', 'AACController::St_Pio_of_Pietrelcina', ['filter' => 'AAC']);
$routes->get('/St_Matthew_the_Evangelist', 'AACController::St_Matthew_the_Evangelist', ['filter' => 'AAC']);
$routes->get('/St_Jerome_of_Stridon', 'AACController::St_Jerome_of_Stridon', ['filter' => 'AAC']);
$routes->get('/St_Francis_of_Assisi', 'AACController::St_Francis_of_Assisi', ['filter' => 'AAC']);
$routes->get('/St_Luke_the_Evangelist', 'AACController::St_Luke_the_Evangelist', ['filter' => 'AAC']);
$routes->get('/St_Cecelia', 'AACController::St_Cecelia', ['filter' => 'AAC']);
$routes->get('/St_Therese_of_Lisieux', 'AACController::St_Therese_of_Lisieux', ['filter' => 'AAC']);
$routes->get('/St_Martin_the_Porres', 'AACController::St_Martin_the_Porres', ['filter' => 'AAC']);
$routes->get('/St_Albert_the_Great', 'AACController::St_Albert_the_Great', ['filter' => 'AAC']);
$routes->get('/St_Stephen', 'AACController::St_Stephen', ['filter' => 'AAC']);
$routes->get('/St_Francis_Xavier', 'AACController::St_Francis_Xavier', ['filter' => 'AAC']);
$routes->get('/St_John_the_Beloved', 'AACController::St_John_the_Beloved', ['filter' => 'AAC']);
$routes->get('/St_Joseph_Freinademetz', 'AACController::St_Joseph_Freinademetz', ['filter' => 'AAC']);
$routes->get('/St_Thomas_Aquinas', 'AACController::St_Thomas_Aquinas', ['filter' => 'AAC']);
$routes->get('/St_Arnold_Janssen', 'AACController::St_Arnold_Janssen', ['filter' => 'AAC']);
$routes->get('/St_Agatha_Sicily', 'AACController::St_Agatha_Sicily', ['filter' => 'AAC']);
$routes->get('/St_Scholastica', 'AACController::St_Scholastica', ['filter' => 'AAC']);

//SEARCH FILTER:
$routes->get('/searchAgatha', 'AACController::searchAgatha', ['filter' => 'AAC']);
$routes->get('/searchAlbert', 'AACController::searchAlbert', ['filter' => 'AAC']);
$routes->get('/searchArnold', 'AACController::searchArnold', ['filter' => 'AAC']);
$routes->get('/searchCatherine', 'AACController::searchCatherine', ['filter' => 'AAC']);
$routes->get('/searchDominic', 'AACController::searchDominic', ['filter' => 'AAC']);
$routes->get('/searchFrancis', 'AACController::searchFrancis', ['filter' => 'AAC']);
$routes->get('/searchGemma', 'AACController::searchGemma', ['filter' => 'AAC']);
$routes->get('/searchJerome', 'AACController::searchJerome', ['filter' => 'AAC']);
$routes->get('/searchJohn', 'AACController::searchJohn', ['filter' => 'AAC']);
$routes->get('/searchJoseph_husband_of_mary', 'AACController::searchJoseph_husband_of_mary', ['filter' => 'AAC']);
$routes->get('/searchJoseph', 'AACController::searchJoseph', ['filter' => 'AAC']);
$routes->get('/searchLawrence', 'AACController::searchLawrence', ['filter' => 'AAC']);
$routes->get('/searchLouise', 'AACController::searchLouise', ['filter' => 'AAC']);
$routes->get('/searchLuke', 'AACController::searchLuke', ['filter' => 'AAC']);
$routes->get('/searchMartin', 'AACController::searchMartin', ['filter' => 'AAC']);
$routes->get('/searchMatthew', 'AACController::searchMatthew', ['filter' => 'AAC']);
$routes->get('/searchPedro', 'AACController::searchPedro', ['filter' => 'AAC']);
$routes->get('/searchPerpetua_felicity', 'AACController::searchPerpetua_felicity', ['filter' => 'AAC']);
$routes->get('/searchPio', 'AACController::searchPio', ['filter' => 'AAC']);
$routes->get('/searchScholastica', 'AACController::searchScholastica', ['filter' => 'AAC']);
$routes->get('/searchStephen', 'AACController::searchStephen', ['filter' => 'AAC']);
$routes->get('/searchThomas', 'AACController::searchThomas', ['filter' => 'AAC']);
$routes->get('/searchXavier', 'AACController::searchXavier', ['filter' => 'AAC']);
$routes->get('/searchCecelia', 'AACController::searchCecelia', ['filter' => 'AAC']);
$routes->get('/searchTherese', 'AACController::searchTherese', ['filter' => 'AAC']);
