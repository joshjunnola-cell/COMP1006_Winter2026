<?php require "includes/header.php" ?>
<main>
  <h2> Order Online - Easy & Simple (And Totally Secure...) 🧁</h2>
  <form action="process.php" method="post">

    <!-- Customer Information -->
    <!-- Step One - Add Client Side Validation with HTML Attributes -->
    <fieldset>
      <legend>Customer Information</legend>
        <label for="first_name">First name</label>
        <input type="text" id="first_name" name="first_name" required>
        <label for="last_name">Last name</label>
        <input type="text" id="last_name" name="last_name" required>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        <label for="text-area">Address</label>
        <input type="text" id="address" name="address" >
    </fieldset>

</form>
</main>
</body>

</html>

<?php require "includes/footer.php" ?>