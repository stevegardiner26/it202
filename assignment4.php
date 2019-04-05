<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Assignment 4</title>
    <link rel="stylesheet" href="./assignment1.css">
</head>
<body>
<div class="container">
    <div class="heading">
        <h3>Patron Sign In Form</h3>
    </div>
    <form onsubmit="validate(event);" id="my-form" class="main" action="process_form.php" method="post">
        <label for="name">Patron Name:</label>
        <input type="text" name="name" id="name"><br>
        <label for="id">Patron ID:</label>
        <input type="password" name="id" id="id"><br>
        <label for="email">Patron Email:</label>
        <input type="text" name="email" id="email"><br>
        <input type="checkbox" name="email-confirm" id="email-confirm">
        <label for="email-confirm">Email me a confirmation</label><br>
        <label for="transaction">Select a Transaction:</label>
        <select name="transaction" id="transaction">
            <option value="add">Schedule a Class</option>
            <option value="remove">Remove a Class</option>
            <option value="view">Search Schedule</option>
            <option value="create">Register/Create</option>
        </select><br>
        <input type="submit" value="Continue" id="submit-btn">
    </form>
    <h1 id="welcome" style="display: none;">Welcome to the Database!</h1>
</div>
</body>
</html>

<style>
    .container {
        font-family: sans-serif;
        color: #ffffff;
        background: #333333;
        margin: auto;
        width: 400px;
        text-align: center;
    }

    .heading {
        background: #000;
        padding: 10px;
    }

    input {
        position: relative;
        margin: 15px;
    }
</style>

<script>
    var patrons = [
        {
            name: 'Steve',
            id: '12392092',
            email: 'steve@gmail.com',
        },
        {
            name: 'Matt',
            id: '12392092',
            email: 'matt@gmail.com',
        },
        {
            name: 'Henry',
            id: '12392092',
            email: 'henry@gmail.com',
        },
        {
            name: 'Joe',
            id: '12392092',
            email: 'joe@gmail.com',
        },
        {
            name: 'Jermain',
            id: '12392092',
            email: 'jermain@gmail.com',
        },
        {
            name: 'Pablo',
            id: '12392092',
            email: 'pablo@gmail.com',
        }
    ];

    function validate(e) {

        var name = document.getElementById('name');
        var id = document.getElementById('id');
        var email = document.getElementById('email');
        var confirm = document.getElementById('email-confirm');
        var transaction = document.getElementById('transaction');

        if(name.value === null || name.value === '') {
            alert('You must enter a name!');
            if(e.preventDefault()) e.preventDefault();
            return false;
        }
        if(id.value === null || id.value === '') {
            alert('You must enter an id!');
            if(e.preventDefault()) e.preventDefault();
            return false;
        }
        if((email.value === null || email.value === '') && confirm.checked) {
            alert('You must enter an email!');
            if(e.preventDefault()) e.preventDefault();
            return false;
        }
        if(id.value.length !== 8) {
            alert('You must enter an 8 digit id.');
            if(e.preventDefault()) e.preventDefault();
            return false;
        }
        if(isNaN(id.value)) {
            alert('You id is not a number!');
            if(e.preventDefault()) e.preventDefault();
            return false;
        }
        if(email.value.indexOf('@') === -1) {
            alert('Your email is missing an \'@\'');
            if(e.preventDefault()) e.preventDefault();
            return false;
        }
        if(email.value.indexOf('.') === -1) {
            alert('Your email is missing a \'.\'');
            if(e.preventDefault()) e.preventDefault();
            return false;
        }

        verify(name.value, id.value, transaction.value);
    }

    function verify(name, id, type) {

    }
</script>