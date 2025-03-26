<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        background: #f4f4f9;
        color: #333;
    }

    .contact-container {
        max-width: 1175px;
        margin: 50px auto;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .contact-container h1 {
        text-align: center;
        color: #007bff;
        margin-bottom: 20px;
    }

    .contact-container p {
        text-align: center;
        font-size: 16px;
        margin-bottom: 30px;
        color: #555;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    input,
    textarea,
    button {
        width: 100%;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
    }

    input:focus,
    textarea:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    button {
        background: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    button:hover {
        background: #0056b3;
    }

    .contact-info {
        text-align: center;
        margin-top: 30px;
    }

    .contact-info p {
        margin: 5px 0;
    }

    .contact-info a {
        color: #007bff;
        text-decoration: none;
    }

    .contact-info a:hover {
        text-decoration: underline;
    }
</style>
</head>

<body>

    <div class="contact-container">
        <h1 style="color:black;">Contact Us</h1>
        <p>We'd love to hear from you! Please fill out the form below for feedback.</p>



        <form action="https://api.web3forms.com/submit" method="POST">

            <!-- Replace with your Access Key -->
            <input type="hidden" name="access_key" value="33152c0c-d118-4c60-84e8-19ccfd89a5cf">

            <input  type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" rows="3" placeholder="Your Message" required></textarea>

            <button type="submit">Submit Form</button>
        </form>
        
    </div>
    </form>
</body>

</html>
<?php
include("homeButton.php");
?>