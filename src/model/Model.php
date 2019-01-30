<?php

include_once("model/Job.php");
include_once("model/Project.php");

class Model {
	public function getJobList()
	{
		// here goes some hardcoded values to simulate the database
		return array(
			"Lucky Vitamin" => new Job("Lucky Vitamin", "Senior .Net Developer", "6/04/2018","current", "<p>Worked to transform a legacy .Net web form e-commerce application to a modern responsive web application. Working with .Net C#, Javascript, JSRender and Sass we took a 15 year old application, retired technical debt, converted XSLT to AJAX/JSON based object oriented application. Integration of application with 3rd party vendors and payment transactors. Implemented business logic on the front and back end. </p>", "lucky100.png","http://www.luckyvitamin.com"),
			
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
			"Asteroids" => new Project("Asteroids", "<p>What started as a simple lesson with my kids on Object Oriented Programming (OOP) eventually morphed into a full blown arcade classic. Based on the vector graphic Atari classic, we rebuild the game dynamics in HTML5 and JS (ES6). Each game piece is its own div, we leveraged SVG’s to keep the graphics crisp when we scaled them. We wrote our own game engine to updated all the pieces and check for collisions. We got lucky and found the original <a href='http://www.classicgaming.cc/classics/asteroids/sounds' target='_blank'>game sounds</a> on line. Updated the styles to make it a little more colorful. Craziest lesson learned was that the entire build is smaller that the background graphic.</p>", "asteroids100b.png","asteroid250.png","http://logikbox.com/asteroids/"),
			
			"Satelite Tracker" => new Project("Satelite Tracker", "<p>I have 2.5 hobbies, Astronomy and Coding (the .5 is cooking but it's also sort of a necessity). Last summer my boys and I were trying to get a photo of the ISS as it flew over our area. After several missed attempts we got serious and started looking it up, mapping its trajectory and we finally decided to code it up in our own project. We hammered this one out in a weekend, they learned the hard lessons of dirty data and how to clean it. You should have seen their faces when I made them sit down in front of Excel and go through our downloaded data. We located some resources on line to get <a href='http://www.n2yo.com' target='_blank'>satellite data</a> via ajax. Though we were only able to get 300 secs of flight data at a time we made it work. Leveraging Google maps and few open API’s we were able to construct a tracker of most of the known orbital bodies flying over head. We are currently working on v2.0, watch this space for updates.</p>", "satelite100.png","satelite250.png","https://securec48.ezhostingserver.com/logikbox-com/satellite/"),
			
			"Mural Arts Finder" => new Project("Mural Arts Finder", "<p>During the the Brownstein Group’s 50th anniversary we ran a program called Brownstein Gives Back. Each team was challenged to come up with a way to give back to our community. We had been working with the Mural Arts program in Philadelphia and I came up with the idea to leverage an existing database Mural Arts had, we developed an app to guide people through the city to see and learn about the murals. The app was location aware, we developed a light Restful API to talk to Mural Arts DB and tied it into Google Maps api for directions. The data was sketchy, so we create a way for user to take and submit photo’s to update the database. They could even report damage. We later took the app and enabled it on their website and it still work with your mobile device. </p>", "mural100.png","mural250.png","https://map.muralarts.org/"),
			
			"Word Clock" => new Project("Word Clock", "<p>This was one of the first coding projects I did with my oldest son. After trying to explain what Dad does at work I decided to show him. Simple little HTML demos turn into the the project that every engineer does once in their lifetime. This one is mine. Written in HTML5, Javascript and CSS 3, we worked out the layout, figured out all the edge cases and built out the clock that is stilled used on the cracked iPad in the family room as the go to clock. </p> ","clock100b.png","clock250.png","http://logikbox.com/clock/"),
			
			"Costume Generator" => new Project("Costume Generator", "<p>This was a fun project I did at a previous job. We were working with Goodwill to promote their Halloween sales. We got to plan and build a simple costume generator that you can choose the simple things you have and build an outfit for the holidays. Half the fun was taking the photos of my team mates all dressed up. Built in HTML5, with PHP backend, Javascript and CSS 3 we were able to deliver a tool that local Goodwill franchises could pull into their sites via a simple  Javascript code and rebrand it locally. The tools was a huge success and help drive sales during their busiest time of the year.</p> ","costume100.png","costume250.png","http://dev.deardorffassociates.com/costume-generator/"),

			"World Cup RSS" => new Project("World Cup RSS", "<p>This was a mash up that I did in under an hour a few years back. Since we couldn’t get the World Cup on at the office we ran this in its place to keep the fans up on the latest happenings with all the matches. Written in PHP with jQuery and CSS, we were able to tap into FIFA’s official press pool feed and spin up the official summaries, stores and press photos in real time and cycle through them for the entire tournament. This was written for a fix resolution device so there is no mobile version to speak of. </p>","worldcup100.png","worldcup250.png","http://logikbox.com/phprss/")		  	
		);
	}
	
	public function getProject($title)
	{
		// we use the previous function to get all the books and then we return the requested one.
		// in a real life scenario this will be done through a db select command
		$allProjects = $this->getProjectsList();
		return $allProjects[$title];
	}

	public function getFirstProject()
	{
		$allProjects = $this->getProjectList();
		return $allProjects["Asteroids"];
	}
	
	
}

?>