<?php

include_once("model/Job.php");
include_once("model/Project.php");

class Model {
	public function getJobList()
	{
		// here goes some hardcoded values to simulate the database
		return array(
			"Lucky Vitamin" => new Job("Lucky Vitamin", "Senior .Net Developer", "6/04/2018","current", "<p>Worked to transform a legacy web form e-commerce application to a modern responsive web application. Working with .Net C#, Javascript, JSRender and Sass we took a 15 year old application, retired technical debt, converted XSLT to AJAX/JSON based object oriented application. Integration of application with 3rd party vendors and payment tractors. Implemented business logic on the front and back end. </p>", "lucky100.png","http://www.luckyvitamin.com"),
			
			"Philadelphia Federal Credit Union" => new Job("Philadelphia Federal Credit Union", "Senior Lead Developer", "2/28/2016","6/1/2018", "<p>Lead developer across multiple work groups, In my role I head programming projects for internal application development and marketing. I also work with core systems, Jack Henry  & Associates Symitar platform, working directly with credit union transaction software with internal records and 3rd party vendor integration. I am personally responsible for custom internal HR software, SharePoint Intranet redesign and website development and management. </p><p>In my role I have successfully integrated my marketing and development knowledge to move application development forward in my time and set new standards for application design, use and interaction. By conducting user interviews, work flow surveys, analytics reviews and best practices mixed with proven design models I was able to increase adoption, streamline the user experience and prioritize information in a more effective manner. Results included higher adoption rates of users, up over 200% and reduced help desk tickets freeing up resources for other work and an overall increase in user satisfaction.</p>", "pfcu-cropped.jpg","http://www.pfcu.com"),
			
			"Brownstein Group" => new Job("Brownstein Group", "Technology Manager", "8/16/2010", "1/24/2016","My role as Technology Manager made me responsible for oversight in all digital projects. I manage a team of developers and UX designers to produce exemplary, award winning interactive projects.  I was tasked with being primary technical contact for clients, doing technology discovery to identifying core features of projects and recommend appropriate technology to accomplish those goals.  I oversaw the execution of project development and personally handle high level programming and database design.  My work includes coordination with strategic and design teams to guarantees all aspect of of the deliverable meet or exceed the project scope. Testing, quality control and post launch client satisfaction complete my responsibilities. Other tasks I took upon myself was to implement an Agile-Scrum workflow, taking responsibility to train Project Management and the dev team on these methodologies. I also personally oversaw the development and training of our junior team members to increase their knowledge and our teams overall effectiveness. ","bg-cropped.jpg","http://www.brownsteingroup.com"),
			
			"160over90" => new Job("160over90", "Senior Developer", "6/1/2008","8/1/2010","As senior developer I work with the creative directors, designers and oversee the interactive department for the definition of projects and to facilitate their creation.  My role is to identify appropriate technologies that create the best possible experience for the users that will allow us to meet our clients goals, define timelines and budget requirements and shepherd the project through the development cycle. Further responsibilities include design and coding of front-end UI experience, backend application programming and integration with 3rd party data services. I am also responsible for the development of internal applications and infrastructure that support the organization and the development group.  I personally mentor each member of my team to share my experiences leading to an expansion of their abilities while encouraging research and continuous learning.  This hands on mentoring has grown the capabilities of the organization and fostered a close team environment.","160-cropped.jpg","http://www.160over90.com"),		  	
			
			"D and D Interactive" => new Job("D and D Interactive", "Senior Developer", "4/1/2006","4/1/2008","Project Lead of a web development team. Planning and design of MS SQL &amp; MySQL databases for a variety of projects and. Application design and coding using Cold Fusion, ASP Classic and Asp.net. Development of content management systems (CMS) and dynamic content systems using database, RSS and XML data sources was my direct responsibility. Oversight of integration with 3rd party application and hosting environments.  Coordination with designers and oversight of junior developers to ensure smooth workflow and targeted project milestone completion. Additional responsibilities included management of the company's five Windows 2003 servers, configuration of IIS 6.0 and maintaining the daily back-up systems.","ddii-cropped.jpg","http://www.ddii.com"),
						
			"Logikbox" => new Job("Logikbox", "Self-Employed Contract Developer", "7/1/2000","4/1/2006","<p>Primarily specializing in web application development and content management solutions. I defined projects with the client and developed strategies to meet their requirements within their budget. Databases design, programming, architecture and coding were my responsibilities. Development was done in Cold Fusion, design of custom CFC&#39;s, ASP classic, PHP and JSP depending on clients needs. I would enlist other contract workers to support projects that required more than just my attention. Project highlights listed below:</p><p>Mondre Energy, Lead developer MEAT Application 1/2003 to 7/2004<br/><p>I led a team of 3 developers to take an existing standalone PC application and re-deployed it for Internet usage. We extended the application functionality to include User profile system, Secure Log-in, Image archive and multi-language support. The application was developed in Cold Fusion and dynamic JavaScript. We reorganized the existing database to expand its functionality and optimized performance.  The application allowed multiple clients to track energy use at multiple locations and see historical trends in data and graphical formats. Users could create custom reports on their data and display them via the website.</p><p>Sony Music, Lead User Interface Developer 2/2000 - 9/2001<br/><p>The Digital Asset Music Network System (DAMNS). Key project features included individual asset level permissions, multi-site/multi-language customization and the ability to customize screen display to meet users &#39;business profile&#39;. I was hired to define the User Interface requirements, develop use case storyboards, involve other stakeholders of the user-interface discussion, requirement definition, usability reviews and use testing sessions. DAMNS was developed in JSP with extensive JavaScript and DHTML to enhance the User Interface.</P>","lbox-cropped.jpg","http://logikbox.com")
			
			 
	
			
		);
	}
	
	public function getJob($title)
	{
		// we use the previous function to get all the books and then we return the requested one.
		// in a real life scenario this will be done through a db select command
		$allJobs = $this->getJobList();
		return $allJobs[$title];
	}
	
	
}

// public $name;
// public $description;
// public $img;
// public $link; 

class Projects{
	public function getProjectList()
	{
		// here goes some hardcoded values to simulate the database
		return array(
			"Asteroids" => new Project("Asteroids", "<p>Worked to transform a legacy web form e-commerce application to a modern responsive web application. Working with .Net C#, Javascript, JSRender and Sass we took a 15 year old application, retired technical debt, converted XSLT to AJAX/JSON based object oriented application. Integration of application with 3rd party vendors and payment tractors. Implemented business logic on the front and back end. </p>", "lucky100.png","http://logikbox.com/asteroids/"),
			
			"Satelite Tracker" => new Project("Satelite Tracker", "<p>Lead developer across multiple work groups, In my role I head programming projects for internal application development and marketing. I also work with core systems, Jack Henry  & Associates Symitar platform, working directly with credit union transaction software with internal records and 3rd party vendor integration. I am personally responsible for custom internal HR software, SharePoint Intranet redesign and website development and management. </p><p>In my role I have successfully integrated my marketing and development knowledge to move application development forward in my time and set new standards for application design, use and interaction. By conducting user interviews, work flow surveys, analytics reviews and best practices mixed with proven design models I was able to increase adoption, streamline the user experience and prioritize information in a more effective manner. Results included higher adoption rates of users, up over 200% and reduced help desk tickets freeing up resources for other work and an overall increase in user satisfaction.</p>", "pfcu-cropped.jpg","https://securec48.ezhostingserver.com/logikbox-com/satellite/"),
			
			"Word Clock" => new Project("Word Clock", "My role as Technology Manager made me responsible for oversight in all digital projects. I manage a team of developers and UX designers to produce exemplary, award winning interactive projects.  I was tasked with being primary technical contact for clients, doing technology discovery to identifying core features of projects and recommend appropriate technology to accomplish those goals.  I oversaw the execution of project development and personally handle high level programming and database design.  My work includes coordination with strategic and design teams to guarantees all aspect of of the deliverable meet or exceed the project scope. Testing, quality control and post launch client satisfaction complete my responsibilities. Other tasks I took upon myself was to implement an Agile-Scrum workflow, taking responsibility to train Project Management and the dev team on these methodologies. I also personally oversaw the development and training of our junior team members to increase their knowledge and our teams overall effectiveness. ","bg-cropped.jpg","http://logikbox.com/clock/"),
			
			"Costume Generator" => new Project("Costume Generator", "As senior developer I work with the creative directors, designers and oversee the interactive department for the definition of projects and to facilitate their creation.  My role is to identify appropriate technologies that create the best possible experience for the users that will allow us to meet our clients goals, define timelines and budget requirements and shepherd the project through the development cycle. Further responsibilities include design and coding of front-end UI experience, backend application programming and integration with 3rd party data services. I am also responsible for the development of internal applications and infrastructure that support the organization and the development group.  I personally mentor each member of my team to share my experiences leading to an expansion of their abilities while encouraging research and continuous learning.  This hands on mentoring has grown the capabilities of the organization and fostered a close team environment.","160-cropped.jpg","http://dev.deardorffassociates.com/costume-generator/"),

			"World Cup RSS" => new Project("World Cup RSS", "As senior developer I work with the creative directors, designers and oversee the interactive department for the definition of projects and to facilitate their creation.  My role is to identify appropriate technologies that create the best possible experience for the users that will allow us to meet our clients goals, define timelines and budget requirements and shepherd the project through the development cycle. Further responsibilities include design and coding of front-end UI experience, backend application programming and integration with 3rd party data services. I am also responsible for the development of internal applications and infrastructure that support the organization and the development group.  I personally mentor each member of my team to share my experiences leading to an expansion of their abilities while encouraging research and continuous learning.  This hands on mentoring has grown the capabilities of the organization and fostered a close team environment.","160-cropped.jpg","http://logikbox.com/phprss/")		  	
	
			
			 
	
			
		);
	}
	
	public function getProject($title)
	{
		// we use the previous function to get all the books and then we return the requested one.
		// in a real life scenario this will be done through a db select command
		$allProjects = $this->getProjectst();
		return $allProjects[$title];
	}
	
	
}

?>