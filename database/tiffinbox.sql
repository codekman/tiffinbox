 
DROP TABLE IF EXISTS `attendance`;

CREATE TABLE `attendance` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `classId` int(11) DEFAULT NULL,
  `sectionId` int(11) DEFAULT NULL,
  `rollNo` int(11) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Table structure for table `batch` */

DROP TABLE IF EXISTS `batch`;

CREATE TABLE `batch` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `batchName` varchar(255) DEFAULT NULL,
  `batchYear` year(4) DEFAULT NULL,
  `batchStatus` tinyint(2) DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `createIp` varchar(255) DEFAULT NULL,
  `createdDatetime` datetime DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updateIp` varchar(255) DEFAULT NULL,
  `updatedDatetime` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `book` */

DROP TABLE IF EXISTS `book`;

CREATE TABLE `book` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `description` text,
  `price` varchar(255) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL COMMENT '0=issued;1=avilable;',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `book_issue` */

DROP TABLE IF EXISTS `book_issue`;

CREATE TABLE `book_issue` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `bookId` int(11) DEFAULT NULL,
  `issueFor` varchar(255) DEFAULT NULL,
  `userType` tinyint(4) DEFAULT NULL COMMENT '1=student,2=others',
  `issuedate` date DEFAULT NULL,
  `issueTill` date DEFAULT NULL,
  `note` text,
  `status` tinyint(2) DEFAULT NULL COMMENT '0=issued,1=available',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `branches` */

DROP TABLE IF EXISTS `branches`;

CREATE TABLE `branches` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `branchName` varchar(255) DEFAULT NULL,
  `branchCode` varchar(255) DEFAULT NULL,
  `branchAddress` text,
  `branchStatus` tinyint(2) DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `createdDatetime` datetime DEFAULT NULL,
  `createIp` varchar(255) DEFAULT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updateIp` varchar(255) DEFAULT NULL,
  `updatedDatetime` datetime DEFAULT NULL,
  `schoolId` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Table structure for table `classes` */

DROP TABLE IF EXISTS `classes`;

CREATE TABLE `classes` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ClassName` varchar(255) DEFAULT NULL,
  `ClassNumaricName` int(2) unsigned zerofill DEFAULT NULL,
  `ClassTeacherId` int(11) DEFAULT NULL,
  `ClassStatus` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `classroutin` */

DROP TABLE IF EXISTS `classroutin`;

CREATE TABLE `classroutin` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `SectionId` int(11) DEFAULT NULL,
  `DayOftheWeekId` int(11) DEFAULT NULL,
  `StartTime` time DEFAULT NULL,
  `EndTime` time DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Table structure for table `dayoftheweek` */

DROP TABLE IF EXISTS `dayoftheweek`;

CREATE TABLE `dayoftheweek` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Day` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `departments` */

DROP TABLE IF EXISTS `departments`;

CREATE TABLE `departments` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `departmentName` varchar(255) DEFAULT NULL,
  `departmentStatus` tinyint(2) DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `createDatetime` datetime DEFAULT NULL,
  `createIp` varchar(255) DEFAULT NULL,
  `updateBy` int(11) DEFAULT NULL,
  `updateDatetime` datetime DEFAULT NULL,
  `updateIp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `designations` */

DROP TABLE IF EXISTS `designations`;

CREATE TABLE `designations` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `designationName` varchar(250) DEFAULT NULL,
  `employeeDepartmentId` tinyint(2) DEFAULT NULL,
  `designationStatus` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Table structure for table `employee` */

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `EmployeeName` varchar(150) DEFAULT NULL,
  `EmployeeDeptId` int(11) DEFAULT NULL,
  `EmployeeDesignationId` int(11) DEFAULT NULL,
  `EmployeeBrithDate` date DEFAULT NULL,
  `EmployeeGender` tinyint(2) DEFAULT NULL,
  `EmployeeAddress` text,
  `EmployeeMobile` varchar(60) DEFAULT NULL,
  `EmployeeEmail` varchar(150) DEFAULT NULL,
  `EmployeeUserName` varchar(60) DEFAULT NULL,
  `EmployeePassword` varchar(255) DEFAULT NULL,
  `EmployeePhoto` varchar(255) DEFAULT NULL,
  `EmployeeBloodGroup` varchar(5) DEFAULT NULL,
  `EmployeeStatus` tinyint(2) DEFAULT '1',
  `IsCommittee` tinyint(2) DEFAULT '0' COMMENT '0=not committee member;1=yes committee member',
  `CommitteePost` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Table structure for table `examgrades` */

DROP TABLE IF EXISTS `examgrades`;

CREATE TABLE `examgrades` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `gradeName` varchar(50) DEFAULT NULL,
  `gradePoint` double(10,2) DEFAULT NULL,
  `markFrom` int(11) DEFAULT NULL,
  `markUpto` int(11) DEFAULT NULL,
  `comments` varchar(500) DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `examGradeStatus` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `examresult` */

DROP TABLE IF EXISTS `examresult`;

CREATE TABLE `examresult` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `examId` int(11) DEFAULT NULL,
  `subjectId` int(11) DEFAULT NULL,
  `classId` int(11) DEFAULT NULL,
  `studentId` int(11) DEFAULT NULL,
  `marksObtained` varchar(50) DEFAULT NULL,
  `attendance` varchar(50) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Table structure for table `exams` */

DROP TABLE IF EXISTS `exams`;

CREATE TABLE `exams` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `examName` varchar(255) DEFAULT NULL,
  `examDate` date DEFAULT NULL,
  `comments` text,
  `examStatus` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `expense_category` */

DROP TABLE IF EXISTS `expense_category`;

CREATE TABLE `expense_category` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(255) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `expenses` */

DROP TABLE IF EXISTS `expenses`;

CREATE TABLE `expenses` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `details` text,
  `expenceCategoryId` int(11) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `mediam` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `fee_type` */

DROP TABLE IF EXISTS `fee_type`;

CREATE TABLE `fee_type` (
  `id` int(55) NOT NULL AUTO_INCREMENT,
  `fee_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `link` */

DROP TABLE IF EXISTS `link`;

CREATE TABLE `link` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `noticeboard` */

DROP TABLE IF EXISTS `noticeboard`;

CREATE TABLE `noticeboard` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `noticeTitle` text,
  `noticeDescription` text,
  `noticeDate` datetime DEFAULT NULL,
  `noticeCreatedBy` int(11) DEFAULT NULL,
  `noticeCreatedDate` datetime DEFAULT NULL,
  `noticeStatus` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `paymentTitle` varchar(255) DEFAULT NULL,
  `paymentDetails` tinytext,
  `paymentType` tinyint(2) DEFAULT '1' COMMENT '1=student payment; 2=others;',
  `classId` int(11) DEFAULT NULL,
  `studentId` int(11) DEFAULT NULL,
  `totalAmount` varchar(255) DEFAULT NULL,
  `createdDate` date DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL COMMENT '1=paid;0=unpaid',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `payment_history` */

DROP TABLE IF EXISTS `payment_history`;

CREATE TABLE `payment_history` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `paymentId` int(11) DEFAULT NULL,
  `paidAmount` varchar(255) DEFAULT NULL,
  `paymentDate` date DEFAULT NULL,
  `medium` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `schools` */

DROP TABLE IF EXISTS `schools`;

CREATE TABLE `schools` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolName` varchar(500) DEFAULT NULL,
  `schoolLogo` varchar(500) DEFAULT NULL,
  `schoolAddress` text,
  `createdDatetime` datetime DEFAULT NULL,
  `cratedIp` varchar(255) DEFAULT NULL,
  `updateDatetime` datetime DEFAULT NULL,
  `updateIp` varchar(255) DEFAULT NULL,
  `schoolStatus` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `sections` */

DROP TABLE IF EXISTS `sections`;

CREATE TABLE `sections` (
  `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ClassId` int(255) DEFAULT NULL,
  `SectionName` varchar(255) DEFAULT NULL,
  `SectionClassTeacherId` int(11) DEFAULT NULL,
  `SectionNumericName` int(2) unsigned zerofill DEFAULT NULL,
  `SectionStatus` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Table structure for table `setting` */

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `institute_name` varchar(500) DEFAULT NULL,
  `institute_logo` varchar(500) DEFAULT NULL,
  `address` text,
  `contact_no` varchar(100) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `contact_us_email` varchar(255) DEFAULT NULL,
  `about_us` text,
  `principal_word` text,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Table structure for table `status` */

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `id` int(255) DEFAULT NULL,
  `status_type_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `studentdetails` */

DROP TABLE IF EXISTS `studentdetails`;

CREATE TABLE `studentdetails` (
  `Id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `StdName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `StdFatherName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `StdMotherName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `StdDOB` date DEFAULT NULL,
  `StdGender` tinyint(2) DEFAULT '1',
  `StdBloodGroup` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `StdProfilePhoto` varchar(450) CHARACTER SET utf8 DEFAULT NULL,
  `StdGardianName` varchar(255) DEFAULT NULL,
  `StdGardianPhoto` varchar(450) CHARACTER SET utf8 DEFAULT NULL,
  `StdGardianSigneture` varchar(450) CHARACTER SET utf8 DEFAULT NULL,
  `StdContactNo` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `StdPresentAddress` varchar(459) CHARACTER SET utf8 DEFAULT NULL,
  `StdPermanentAddress` varchar(450) CHARACTER SET utf8 DEFAULT NULL,
  `StdAdmissionYear` year(4) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=latin1;

/*Table structure for table `studentinfo` */

DROP TABLE IF EXISTS `studentinfo`;

CREATE TABLE `studentinfo` (
  `Id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `StdDetailsId` int(11) DEFAULT NULL,
  `StdCurrentId` varchar(255) DEFAULT NULL,
  `StdCashId` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `StdRollNo` int(3) unsigned zerofill DEFAULT NULL,
  `StdClassId` int(2) unsigned zerofill DEFAULT NULL,
  `StdSectionId` int(2) unsigned zerofill DEFAULT NULL,
  `StdStatus` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=latin1;

/*Table structure for table `subjects` */

DROP TABLE IF EXISTS `subjects`;

CREATE TABLE `subjects` (
  `Id` int(55) NOT NULL AUTO_INCREMENT,
  `SubjectName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `SubjectCode` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `SubjectClassId` int(2) unsigned DEFAULT NULL,
  `SubjectIsMust` tinyint(2) DEFAULT '1',
  `SubjectIsOptional` tinyint(2) DEFAULT '0',
  `SubjectStatus` tinyint(2) DEFAULT '1',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `type_id` int(100) DEFAULT NULL,
  `full_name` varchar(450) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(450) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `last_login_time` varchar(765) DEFAULT NULL,
  `last_login_ip` varchar(765) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Table structure for table `user_type` */

DROP TABLE IF EXISTS `user_type`;

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
 