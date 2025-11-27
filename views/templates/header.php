<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JDM Workshop System</title>
    <style>
        :root {
            --bg-dark: #0a0b10;
            --panel-bg: #13151a;
            --neon-blue: #00f3ff;
            --neon-pink: #ff0055;
            --text-main: #e0e6ed;
        }
        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0; padding: 20px;
        }
        h1, h2, h3 { 
            text-transform: uppercase; 
            letter-spacing: 2px; 
            color: var(--neon-blue);
            text-shadow: 0 0 10px rgba(0, 243, 255, 0.5);
        }
        .container { max-width: 1200px; margin: 0 auto; }
        
        /* TABLE STYLING - JDM STYLE */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: var(--panel-bg); }
        th { 
            background: #1a1d24; 
            color: var(--neon-blue); 
            padding: 15px; text-align: left; 
            border-bottom: 2px solid var(--neon-blue);
        }
        td { padding: 15px; border-bottom: 1px solid #333; }
        tr:hover { background: #1f2229; }

        /* BADGES */
        .badge-vip { 
            background: var(--neon-pink); color: white; 
            padding: 2px 6px; font-size: 0.7em; border-radius: 4px; 
            box-shadow: 0 0 8px var(--neon-pink);
        }
        .engine-badge {
            color: #888; font-family: monospace; background: #222; padding: 2px 4px;
        }
        
        /* BUTTONS */
        .btn {
            display: inline-block; padding: 10px 20px; margin: 5px;
            text-decoration: none; font-weight: bold;
            border: 1px solid var(--neon-blue); color: var(--neon-blue);
            transition: 0.3s;
        }
        .btn:hover {
            background: var(--neon-blue); color: black;
            box-shadow: 0 0 15px var(--neon-blue);
        }
        .btn-danger { border-color: var(--neon-pink); color: var(--neon-pink); }
        .btn-danger:hover { background: var(--neon-pink); color: white; box-shadow: 0 0 15px var(--neon-pink); }

        /* FORM */
        .form-group { margin-bottom: 15px; }
        input, select {
            width: 100%; padding: 10px; background: #222; border: 1px solid #444; color: white;
        }
        input:focus, select:focus { outline: none; border-color: var(--neon-blue); }
    </style>
</head>
<body>
<div class="container">
    <h1>JDM Performance Workshop </h1>
    <hr style="border-color: #333;">
    <nav style="margin-bottom: 20px;">
        <a href="index.php?page=booking_list" class="btn">BOOKINGS</a>
        <a href="index.php?page=car_list" class="btn">CARS</a>
        <a href="index.php?page=owner_list" class="btn">OWNERS</a>
        <a href="index.php?page=mech_list" class="btn">TUNERS</a>
        <a href="index.php?page=service_list" class="btn">SERVICES</a>
    </nav>