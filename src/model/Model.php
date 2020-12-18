<?php

include_once("model/Job.php");
include_once("model/Project.php");

class Jobs
{
	public function getJobList()
	{
		// here goes some hardcoded values to simulate the database
		return array(
			"LuckyVitamin" => new Job("Lucky Vitamin", "Senior .Net Developer", "6/04/2018", "current", "<p>As a senior developer I maintain and support ongoing efforts for our e-commerce platform. A primary role was leading the site conversion to responsive design. </p><p>Worked with the team to migrate from web forms environment to MVC design patterns. Development of internal and outward facing API’s for our use and for 3rd party vendors. Supported and implemented a custom web api to allow for the transition from XLST to JSON. Worked with designers to create a modern responsive UI and translate their designs into code. Created a JavaScript framework to support the application using JSON and JSRender to create server-side rendering methodologies to improve performance. Audited and implemented JavaScript and CSS changes to reduce page load time by up to 60%. Worked to integrate 3rd party platforms to work seamlessly with our site and internal platforms.</p>", "lucky100.png", "http://www.luckyvitamin.com", "LuckyVitamin"),

			"PFCU" => new Job("Philadelphia Federal Credit Union", "Senior Lead Developer", "2/28/2016", "6/1/2018", "<p>As lead developer across multiple work groups, I headed programming projects for internal application development and marketing. </p><p>Worked with core systems, Jack Henry & Assoc. Symitar platform, working directly with credit union transaction software with internal records and 3rd party vendor integration. Personally, responsible for custom internal HR software, SharePoint Intranet redesign and website development and management. Primary tasks include updating VB6 standalone tools into an Intranet based environment using ASP.Net (C# & VB) and the MVC design structure. Migration of Access 98 databases to MSSQL and creating custom interface using best practice UX design, jQuery, Angular JS and Bootstrap.  In this role, successfully integrated marketing and development knowledge to move application development forward and set new standards for application design, use and interaction. By conducting user interviews, work flow surveys, analytics reviews and best practices mixed with proven design models, increased adoption, streamlined the user experience and prioritized information in a more effective manner. Results included higher adoption rates of users of over 200% and reduction of help desk tickets, freeing up resources for other work and an overall increase in user satisfaction.</p>", "pfcu-cropped.jpg", "http://www.pfcu.com", "PFCU"),

			"BrownsteinGroup" => new Job("Brownstein Group", "Technology Manager", "8/16/2010", "1/24/2016", "<p>As Technology Manager, I had oversight in all digital projects, managing a team of developers and UX designers to produce exemplary, award winning interactive projects.</p><p>Tasked as primary technical contact for clients, from technology discovery to identifying core features of projects and recommending appropriate technology to accomplish those goals. Oversaw the execution of project development and personally handled high level programming and database design. Included coordination with strategic and design teams to guarantees all aspect of the deliverable met or exceeded the project scope. Testing, quality control and post launch client satisfaction responsibilities. Took upon myself to implement an Agile-Scrum workflow, taking responsibility to train Project Management and the dev team on these methodologies. Personally, oversaw the development and training of our junior team members to increase their knowledge and our teams’ overall effectiveness.</p>", "bg-cropped.jpg", "http://www.brownsteingroup.com", "BrownsteinGroup"),

			"160over90" => new Job("160over90", "Senior Developer", "6/1/2008", "8/1/2010", "<p>As senior developer I worked with the creative directors and designers and oversaw the interactive department for the definition of projects and facilitation of their creation.</p><p>Identified appropriate technologies that created the best possible experience for the users that allowed us to meet our clients’ goals, define timelines and budget requirements and shepherd the projects through the development cycle. Responsibilities included design and coding of front-end UI experience, backend application programming and integration with 3rd party data services. Also responsible for the development of internal applications and infrastructure that supported the organization and the development group. Personally, mentor each member of my team to share my experiences leading to an expansion of their abilities while encouraging research and continuous learning. This hands-on mentoring has grown the capabilities of the organization and fostered a close team environment.</p>", "160-cropped.jpg", "http://www.160over90.com", "160over90"),

			"DDII" => new Job("D and D Interactive", "Senior Developer", "4/1/2006", "4/1/2008", "Project Lead of a web development team. Planning and design of MS SQL &amp; MySQL databases for a variety of projects and. Application design and coding using Cold Fusion, ASP Classic and Asp.net. Development of content management systems (CMS) and dynamic content systems using database, RSS and XML data sources was my direct responsibility. Oversight of integration with 3rd party application and hosting environments.  Coordination with designers and oversight of junior developers to ensure smooth workflow and targeted project milestone completion. Additional responsibilities included management of the company's five Windows 2003 servers, configuration of IIS 6.0 and maintaining the daily back-up systems.", "ddii-cropped.jpg", "http://www.ddii.com", "DDII"),

			"Logikbox" => new Job("Logikbox", "Self-Employed Contract Developer", "7/1/2000", "4/1/2006", "<p>Primarily specializing in web application development and content management solutions. I defined projects with the client and developed strategies to meet their requirements within their budget. Databases design, programming, architecture and coding were my responsibilities. Development was done in Cold Fusion, design of custom CFC&#39;s, ASP classic, PHP and JSP depending on clients needs. I would enlist other contract workers to support projects that required more than just my attention. Project highlights listed below:</p><p>Mondre Energy, Lead developer MEAT Application 1/2003 to 7/2004<br/><p>I led a team of 3 developers to take an existing standalone PC application and re-deployed it for Internet usage. We extended the application functionality to include User profile system, Secure Log-in, Image archive and multi-language support. The application was developed in Cold Fusion and dynamic JavaScript. We reorganized the existing database to expand its functionality and optimized performance.  The application allowed multiple clients to track energy use at multiple locations and see historical trends in data and graphical formats. Users could create custom reports on their data and display them via the website.</p><p>Sony Music, Lead User Interface Developer 2/2000 - 9/2001<br/><p>The Digital Asset Music Network System (DAMNS). Key project features included individual asset level permissions, multi-site/multi-language customization and the ability to customize screen display to meet users &#39;business profile&#39;. I was hired to define the User Interface requirements, develop use case storyboards, involve other stakeholders of the user-interface discussion, requirement definition, usability reviews and use testing sessions. DAMNS was developed in JSP with extensive JavaScript and DHTML to enhance the User Interface.</P>", "lbox-cropped.jpg", "https://logikbox.com", "Logikbox")
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

class Projects
{
	public function getProjectList()
	{
		// here goes some hardcoded values to simulate the database
		return array(
			"Tardis" => new Project("Tardis", "<p></p>Dates have always been my kryptonite. So many formats &amp; standards for the many ways to work with them in every different programming language. Maddening. I have been refining my site over the last few months I’ve added a great deal of features and data. Toss in a few API’s and their mixed and matched data, things were beginning to getting sloppy. Doing a code review I noticed I was doing the same thing in 4 separate files to format dates from different sources. My first thought was to standardize the process in a function and use that as date format controller.  While planning I opted to make it a module so I could use it on other projects and if I update it one place I can update it everywhere with npm. What started as a basic formatter, then grew into a standards converter and finally a full blown free form pattern mapping Time/Date formatting tool. Supporting Unix timestamps, ISO and UTC time stamps you can imput any combo and be returned in an object with multiple values in dozens of formats to use as you need. You can also use the prebuilt filters for quick standardized formats and you can even add your own masks and receive back the format of your choosing. It is available on NPM, just look for lbx-tardis.</p>", "tardis100.png", "tardis.webp", "/tardis/"),

			"Asteroids" => new Project("Asteroids", "<p>What started as a simple lesson with my kids on Object Oriented Programming (OOP) eventually morphed into a full blown arcade classic. Based on the vector graphic Atari classic, we rebuilt the game dynamics in HTML5 and JS (ES6). Each game piece is its own div, we leveraged SVG’s to keep the graphics crisp when we scaled them. We wrote our own game engine to update all the pieces and check for collisions. We got lucky and found the original <a href='http://www.classicgaming.cc/classics/asteroids/sounds' target='_blank' rel='noopener'>game sounds</a> on line. Updated the styles to make it a little more colorful. Craziest lesson learned was that the entire build is smaller than the background graphic.</p>", "asteroids100b.png", "asteroid250.png", "https://logikbox.com/asteroids/"),

			"Satellite Tracker" => new Project("Satellite Tracker", "<p>I have 2.5 hobbies, Astronomy and Coding (the .5 is cooking but it's also sort of a necessity). During the summer of 2018 my boys and I were trying to get a photo of the ISS as it flew over our area. After several missed attempts we got serious and started looking it up, mapping its trajectory and we finally decided to code it up in our own project. We hammered this one out in a weekend, they learned the hard lessons of dirty data and how to clean it. You should have seen their faces when I made them sit down in front of Excel and go through our downloaded data. We located some resources on line to get <a href='http://www.n2yo.com' target='_blank' rel='noopener' aria-haspopup='true'>satellite data</a> via ajax. Though we were only able to get 300 secs of flight data at a time we made it work. Leveraging Google maps and few open API’s we were able to construct a tracker of most of the known orbital bodies flying over head. We are currently working on <a href='https://satellite.logikbox.com/'>v2.0</a>, watch this space for updates.</p>", "satelite100.png", "satelite250.png", "https://logikbox.com/satellite/"),

			"Mural Arts Finder" => new Project("Mural Arts Finder", "<p>During the Brownstein Group’s 50th anniversary we ran a program called Brownstein Gives Back. Each team was challenged to come up with a way to give back to our community. We had been working with the Mural Arts program in Philadelphia and I came up with the idea to leverage an existing database Mural Arts had on hand. We developed an app to guide people through the city to see and learn about the murals. The app was location aware, we developed a light Restful API to talk to Mural Arts DB and tied it into Google Maps api for directions. The data was sketchy, so we create a way for user to capture and submit photo’s to update the database. They could even report damage. We later redevelpped the app and enabled it on their website and it still work with your mobile device. </p>", "mural100.png", "mural250.png", "https://map.muralarts.org/"),

			"Word Clock" => new Project("Word Clock", "<p>This was one of the first coding projects I did with my oldest son. After trying to explain what Dad does at work I decided to show him. Simple little HTML demos turn into the the project that every engineer does once in their lifetime. This one is mine. Written in HTML5, Javascript and CSS 3, we worked out the layout, figured out all the edge cases and built out the clock that is stilled used on the cracked iPad in the family room as the go to clock. </p>", "clock100b.png", "clock250.png", "https://logikbox.com/clock/"),

			"Costume Generator" => new Project("Costume Generator", "<p>This was a fun project I did at a previous job. We were working with Goodwill to promote their Halloween sales. We got to plan and build a simple costume generator that you can choose the simple things you have and build an outfit for the holidays. Half the fun was taking the photos of my team mates all dressed up. Built in HTML5, with PHP backend, Javascript and CSS 3 we were able to deliver a tool that local Goodwill franchises could pull into their sites via a simple  Javascript code and rebrand it locally. The tools was a huge success and help drive sales during their busiest time of the year.</p>", "costume100.png", "costume250.png", "http://dev.deardorffassociates.com/costume-generator/"),

			"World Cup RSS" => new Project("World Cup RSS", "<p>This was a mash up that I did in under an hour a few years back. Since we couldn’t get the World Cup on at the office we ran this in its place to keep the fans up on the latest happenings with all the matches. Written in PHP with jQuery and CSS, we were able to tap into FIFA’s official press pool feed and spin up the official summaries, stories and press photos in real time and cycle through them for the entire tournament. This was written for a fix resolution device so there is no mobile version to speak of. </p>", "worldcup100.png", "worldcup250.png", "https://logikbox.com/phprss/")
		);
	}

	public function getProject($title)
	{
		$allProjects = $this->getProjectsList();
		return $allProjects[$title];
	}

	public function getFirstProject()
	{
		$allProjects = $this->getProjectList();
		$keys = array_keys($allProjects);
		$maxProj = count($keys) - 1;
		return $allProjects[$keys[mt_rand(0, $maxProj)]];
	}
}
