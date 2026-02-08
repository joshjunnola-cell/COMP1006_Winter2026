<?php require "includes/header.php" ?>
    <main>
    <h2> 🧁 Customer Form:</h2>
    <form action="process.php" method="post">

        <!-- Customer Information -->
        <!-- Step One - Add Client Side Validation with HTML Attributes -->
        <fieldset>
        <legend>Customer Information/Request form:</legend>
            <label for="first_name">First name</label>
            <input type="text" id="first_name" name="first_name" required>
            <label for="last_name">Last name</label>
            <input type="text" id="last_name" name="last_name" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" cols="30" minlength="10" maxlength="300"> </textarea> 
        </fieldset>

        <p>
        <button type="submit">Place Order</button>
        </p>
        </form>
    </main>
</body>

</html>

<?php require "includes/footer.php" ?>