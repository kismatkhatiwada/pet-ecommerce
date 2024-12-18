<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Pet Pal</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <style>
        /* Global styles */
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            color: #333; /* Text color */
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        header {
            text-align: center;
            margin-bottom: 30px;
        }

        header h1 {
            color: #4CAF50; /* Greenish color for headings */
        }

        section {
            margin-bottom: 30px;
        }

        section h2 {
            color: #4CAF50;
            margin-bottom: 15px;
        }

        .values-list {
            display: flex;
            justify-content: space-around;
            gap: 20px;
        }

        .value {
            flex: 1;
            padding: 15px;
            border-radius: 5px;
            background-color: #f0f0f0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .value h3 {
            color: #4CAF50;
            margin-bottom: 10px;
        }

        .team-members {
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        .team-member {
            text-align: center;
            max-width: 200px;
        }

        .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

       

        
    </style>
</head>
<body>

<div class="container">
    <header>
        <h1>About Pet Pal</h1>
        <p>Welcome to Pet Pal, where pets are family! We are dedicated to enriching the lives of pets and their owners through exceptional products and heartfelt services.</p>
    </header>

    <section id="mission">
        <h2>Our Mission</h2>
        <p>At Pet Pal, our mission is to foster the well-being of pets by promoting responsible pet ownership, providing superior pet care products, and supporting animal welfare initiatives. We aim to create a community where every pet receives the love and care they deserve.</p>
    </section>

    <section id="values">
        <h2>Our Values</h2>
        <div class="values-list">
            <div class="value">
                <h3>Compassion</h3>
                <p>We demonstrate compassion by treating all pets with kindness, empathy, and respect, ensuring their well-being is our top priority.</p>
            </div>
            <div class="value">
                <h3>Integrity</h3>
                <p>We uphold the highest standards of integrity, honesty, and transparency in our interactions with customers, partners, and communities.</p>
            </div>
            <div class="value">
                <h3>Quality</h3>
                <p>We are committed to providing superior quality products and services that meet the diverse needs of pet owners, ensuring the health and happiness of their pets.</p>
            </div>
            <div class="value">
                <h3>Community</h3>
                <p>We value building strong relationships within our community, fostering a supportive environment for pet owners and animal lovers alike.</p>
            </div>
        </div>
    </section>

    <section id="team">
        <h2>Meet Our Team</h2>
        <div class="team-members">
            <div class="team-member">
                <img src="../photos/sudeep.jpg" alt="Team Member 1">
                <h3>Sudip ghimire</h3>
                <p>Founder & CEO</p>
            </div>
            <div class="team-member">
                <img src="../photos/kismat.jpg" alt="Team Member 2">
                <h3>Kismat khatiwada</h3>
                <p>Head of Operations</p>
            </div>
            <!-- Add more team members as needed -->
        </div>
    </section>
</div>



</body>
</html>

<footer>
    <p>&copy; 2024 Pet Pal. All rights reserved. | <a href="index.php">Back to Home</a></p>
</footer>