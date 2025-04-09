<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beautiful CV</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    /* Global Styles */
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f9;
      color: #333;
    }

    .cv-container {
      max-width: 1200px;
      margin: 20px auto;
      background: #fff;
      display: flex;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Sidebar */
    .sidebar {
      width: 25%;
      background: #1b153e;
      color: #fff;
      padding: 20px;
      display: flex;
      flex-direction: column;
     
    }

    .sidebar .photo img {
      width: 130px;
      height: 130px;
      border-radius: 50%;
      border: 4px solid #fff;
      object-fit: cover;
      margin-left: 80px;
    }

    .sidebar h2 {
      margin: 10px 0 10px;
      font-size: 20px;
      text-transform: uppercase;
      border-bottom: 2px solid #fff;
      display: inline-block;
      padding-bottom: 5px;
    }

    .sidebar p, .sidebar ul {
      font-size: 14px;
      margin: 10px 0;
    }

    .sidebar ul {
      padding: 0;
      list-style: none;
    }

    .sidebar ul li {
      margin: 5px 0;
      margin-bottom: 10px;
    }

    .sidebar ul li i {
      margin-right: 8px;
    }

     .name-profession {
  text-align: center;
  margin-top: 10px;
}

.name-profession h1 {
  font-size: 20px;
  font-weight: bold;
  margin: 5px 0;
  color: #fff;
}

.name-profession h3 {
  font-size: 14px;
  font-weight: normal;
  color: #ccc;
  margin: 0;
}
    /* Main Content */
    .content {
      width: 70%;
      padding: 20px 30px;
    }

    .content header {
      border-bottom: 2px solid #1b153e;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    .content header h1 {
      font-size: 32px;
      margin: 0;
      color: #1b153e;
    }

    .content header h2 {
      font-size: 18px;
      color: #555;
    }

    .content section {
      margin-bottom: 10px;
    }

    .content section h2 {
      font-size: 20px;
      color: #1b153e;
      margin-bottom: 5px;
      border-bottom: 2px solid #ddd;
      padding-bottom: 5px;
      display: inline-block;
    }

    .content section p {
      font-size: 16px;
      line-height: 1.6;
      margin: 10px 0;
    }

    .content section ul {
      padding-left: 20px;
    }

    .content section ul li {
      margin-bottom: 8px;
    }

    .content section ul li i {
      margin-right: 10px;
      color: #1b153e;
    }
.skills li {
  margin-bottom: 15px;
}

.skills span {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

.stars {
  color: #ffc107; /* Gold color for stars */
  font-size: 16px;
}

.stars .fas,
.stars .far {
  margin-right: 2px;
}


 .education {
        font-family: Arial, sans-serif;
        margin: 20px 0;
    }
    .education h2 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #007bff;
    }
    .education-grid {
        display: flex;
        gap: 20px;
    }
    .education-item {
        flex: 1;
        border-radius: 8px;
        padding: 15px;
       
    }
    .education-item h3 {
        margin: 0 0 10px;
        font-size: 18px;
        color: #333;
    }
    .education-item p {
        margin: 5px 0;
        font-size: 16px;
    }

    .experience {
   font-family: Arial, sans-serif;
        margin: 5px 0;
}

.experience-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}


.achievements h2{
  margin: 5px 0;
}

.projects h2 {
    margin: 20px 0 10px;
  }
  .project-item {
    margin-bottom: 15px;
  }
  .project-item h3 {
    font-size: 18px;
    margin: 10px 0 5px;
    color: #1b153e;
  }
  .project-links a {
    color: #1b153e;
    text-decoration: none;
    margin-right: 15px;
    font-weight: bold;
  }
  .project-links a:hover {
    text-decoration: underline;
  }
  .project-links i {
    margin-right: 5px;
  }
  

  </style>
</head>
<body>
  <div class="cv-container">
    <aside class="sidebar">
      <div class="photo">
        <img src="{{asset('img/unnamed.jpg')}}" alt="Profile Picture">
      </div>
       <div class="name-profession">
  <h1>Nabeel Afzal</h1>
  <h3>Laravel Developer</h3>
</div>
<br>
      
  <h2 class="contact-heading"><i class="fas fa-address-book"></i> Personal Information</h2>
 <ul>
                <li><i class="fas fa-user icon"></i><strong>Full Name:</strong>Nabeel Afzal</li>
    <li><i class="fas fa-birthday-cake icon"></i><strong>Date of Birth:</strong> 23rd October 1996</li>
         <li><i class="fas fa-mars icon"></i><strong>Gender:</strong> Male | Single</li>
    <li><i class="fas fa-id-card icon"></i><strong>CNIC:</strong> 38403-1795846-5</li>
    <!-- <li><i class="fas fa-home icon"></i><strong>Permanent Address:</strong> Block 10 Sargodha</li> -->
    <li><i class="fas fa-praying-hands icon"></i><strong>Religion:</strong> Islam</li>
 </ul>
 <h2 class="contact-heading"><i class="fas fa-address-book"></i> Contact</h2>
 <ul>
        <li><i class="fas fa-phone"></i> 0327-7798300</li>
        <li><i class="fas fa-envelope"></i> nabeel.afzal.sheikh@gmail.com</li>
        <li><i class="fas fa-map-marker-alt"></i>3-S-79 Block 10 Sargodha </li>
 </ul>
<h2 class="skills-heading"><i class="fas fa-cogs"></i> Skills</h2>
<ul class="skills">
  <li>
    <span><i class="fas fa-code"></i>Html | CSS</span>
    <div class="stars">
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="far fa-star"></i>
    </div>
  </li>
  <li>
<span><i class="fab fa-js"></i> JavaScript | jQuery | Vue.js</span>
    <div class="stars">
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star-half-alt"></i>
      <i class="far fa-star"></i>
    </div>
  </li>
  <li>
    <span><i class="fas fa-server"></i>PHP | Laravel | API | Datatables</span>
    <div class="stars">
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star-half-alt"></i>
    </div>
  </li>
  <li>
    <span><i class="fas fa-database"></i>Database MySQL | Eloquent ORM</span>
    <div class="stars">
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star-half-alt"></i>
    </div>
  </li>
  <li>
    <span><i class="fas fa-tools"></i>GitHub | Filezilla | PuTTY</span>
    <div class="stars">
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star-half-alt"></i>
      <i class="far fa-star"></i>

    </div>
  </li>
</ul>


<h2 class="languages-heading"><i class="fas fa-language"></i> Languages</h2>
       <ul>
        <li><i class="fas fa-language"></i> Urdu</li>
        <li><i class="fas fa-globe"></i> English (Level B1)</li>
      </ul>

  <h2 class="hobbies-heading"><i class="fas fa-user-friends"></i> Hobbies</h2>
      <ul>
        <li><i class="fas fa-fish"></i> Fishing</li>
        <li><i class="fas fa-circle"></i> Snooker</li>
      </ul>
    </aside>

    <main class="content">
      
      <section class="profile">
        <h2><i class="fas fa-user"></i> Profile</h2>
        <p>I am a passionate Laravel developer with 1 year of experience in web development. I have a strong foundation in PHP, HTML, CSS, and Vue.js, complemented by 4 years of experience in college IT lab management and marketing. I bring a problem-solving mindset and a love for creating efficient applications.
I am dedicated to continuous learning and staying updated with the latest technologies. My goal is to leverage my skills in a challenging role that allows me to contribute to innovative projects while further enhancing my expertise in Laravel and web development.</p>
        </p>
      </section>

    <section class="education">
    <h2><i class="fas fa-graduation-cap"></i> Education</h2>
    <div class="education-grid">
      <div class="education-item">
            <h3><i class="fas fa-laptop-code"></i> BSCS</h3>
            <p><strong>Year:</strong> 2019</p>
            <p><strong>Institution:</strong> Superior College </p>
            <p><strong>CGPA:</strong> 3.0</p>
        </div>
       
        <div class="education-item">
            <h3><i class="fas fa-user-graduate"></i> FSc (Engineering)</h3>
            <p><strong>Year:</strong> 2014</p>
            <p><strong>Board:</strong> Sargodha Board</p>
            <p><strong>Institution:</strong> ILM College</p>
        </div>
         <div class="education-item">
            <h3><i class="fas fa-school"></i> Matriculation</h3>
            <p><strong>Year:</strong> 2012</p>
            <p><strong>Board:</strong> Federal Board</p>
            <p><strong>Institution:</strong> Army Public School</p>
        </div>
    </div>
</section>

     <section class="experience">
    <h2><i class="fas fa-briefcase"></i> Professional Experience</h2>
    <div class="experience-grid">
        <div class="job">
            <h3>Laravel Developer, CraveTeck</h3>
            <p><em>January 2024 – August 2024</em></p>
            <ul>
       
        <li><i class="fas fa-arrow-right"></i> Build APIs for seamless mobile app integration.</li>
        <li><i class="fas fa-arrow-right"></i> Generate reports using YajraBox DataTables.</li>
     <li><i class="fas fa-arrow-right"></i>  Convert static websites into dynamic, database-driven applications.</li>
         <li><i class="fas fa-arrow-right"></i> Develop a custom dashboard with authentication, authorization, and role-based access control.</li>
            </ul>
        </div>
        <div class="job">
            <h3>Lab In-Charge, Allama Iqbal Law College</h3>
            <p><em>December 2020 – December 2023</em></p>
            <ul>
                <li><i class="fas fa-arrow-right"></i> Maintain and update the lab equipment inventory.</li>
   <li><i class="fas fa-arrow-right"></i>Ensure all software and systems in the lab are up-to-date and functional.</li>
   <li><i class="fas fa-arrow-right"></i>Assist students and faculty with technical issues and lab usage.</li>
               
            </ul>
        </div>
    </div>
</section>
<!-- <section class="portfolio">
    <h2><i class="fas fa-briefcase"></i> Portfolio</h2>
    <ul>
          <li><a href="https://github.com/yourusername/ecommerce-platform" target="_blank">E-commerce Website</a> - A fully responsive e-commerce platform with payment integration.</li>
        <li><a href="https://github.com/yourusername/blog-management" target="_blank">Blog Management System</a> - A dynamic blog platform with user authentication and content management features.</li>
        <li><a href="https://github.com/yourusername/hospital-management" target="_blank">Hospital Management System</a> - A comprehensive system for managing hospital operations.</li>
        <li><a href="https://github.com/yourusername/order-taker-app" target="_blank">Order Taker App with Accounting Feature</a> - A full-fledged order management system with built-in accounting features like journal entries, ledger, and double-entry system.</li>
        <li><a href="https://github.com/yourusername/job-portal" target="_blank">Job Portal</a> - A job portal platform with employer and job seeker functionalities, including job posting, application management, and profile creation.</li>
        <li><a href="https://github.com/yourusername/saas-laundry-management" target="_blank">SaaS Laundry Management System</a> - A SaaS-based platform for managing laundry services with features for order tracking, payment, and customer management.</li>
  

    </ul>
</section> -->
<section class="achievements">
    <h2><i class="fas fa-trophy"></i> Achievements</h2>
    <ul>
      <li>Achieved <strong>95/100</strong> in PHP, the highest marks in the class.</li>
         <li>Scored <strong>80/100</strong> for an individual Final Project: A SaaS-based appointment management system for city hospitals, built with Core PHP.</li>
    </ul>
</section>

<!-- NEW PROJECTS SECTION -->
<section class="projects">
    <h2><i class="fas fa-code"></i> Projects</h2>

    <!-- AIL.edu.pk - College Management System -->
    <div class="project-item">
        <h3>ail.edu.pk – College Management System</h3>
        <ul>
            <li>
                <i class="fas fa-check"></i> Developed a **complete college management system** as a **freelance project**, handling **admissions, student records, faculty management, and academic sessions**.
            </li>
            <li>
                <a href="https://github.com/nabeelafzalsheikh/inventory_app" target="_blank">
                    <i class="fab fa-github"></i> GitHub: https://github.com/nabeelafzalsheikh/ail.edu.pk.git
                </a>
            </li>
            <li>
                <a href="http://nabeelafzal.rf.gd" target="_blank">
                    <i class="fas fa-external-link-alt"></i> Live Demo: https://ail.edu.pk/
                </a>
            </li>
        </ul>
    </div>

    <!-- Inventory Management System -->
    <div class="project-item">
        <h3>Inventory Management System (with Auth & Authorization)</h3>
        <ul class="project-links">
            <li>
                <a href="https://github.com/nabeelafzalsheikh/inventory_app" target="_blank">
                    <i class="fab fa-github"></i> GitHub: https://github.com/nabeelafzalsheikh/inventory_app
                </a>
            </li>
            <li>
                <a href="http://nabeelafzal.rf.gd" target="_blank">
                    <i class="fas fa-external-link-alt"></i> Live Demo: http://nabeelafzal.rf.gd
                </a>
            </li>
            <li>
                <i class="fas fa-check"></i> Developed a secure system with <strong>role-based access control</strong>, 
                <strong>Spatie Permissions</strong> for authorization, and <strong>MySQL</strong> for efficient inventory tracking.
            </li>
        </ul>        
    </div>
</section>


<section class="references">
    <h2><i class="fas fa-address-book"></i> References</h2>
    <p>References will be furnished on demand.</p>
</section>
    </main>
  </div>
</body>
</html>
