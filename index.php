<?php
require("connection.php");
//VARIABLES//
$conn = connectToDB();
$idcat = 1;

if(isset($_GET['heroId'])) {
  $heroId = $_GET['heroId'];
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Get all teams
$sql2 = "SELECT * from team";
$result2 = $conn->query($sql2);

//get specific hero from team
if(isset($_GET['teamId']))
{
    $sql = "SELECT * FROM hero WHERE teamId =  " . $_GET['teamId'];
}
else {
  $sql = "SELECT * FROM hero";
}
$result = $conn->query($sql);

//Get hero details
if (!isset($_GET['heroId'])) {
  $sql3 = "SELECT * from hero";
}
else {
    $sql3 = "SELECT * from hero WHERE heroId = " . $_GET['heroId'];
}
$result3 = $conn->query($sql3);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="description" content="DC Heroes">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>DC Heroes</title>
</head>
<body>

	<header id="header">
		<img src="img/DC.png" width="100" height="100" id="logo"><h1 id="header1">Heroes<h1>
	</header>
	
	<div id="main-container">

		<div id="main-left">
			<nav id="teams">
				<ul><div id="teamnames">
					<h1 id="headerteam">Teams</h1>
					<?php 
					if ($result2->num_rows > 0) {
					while($row = $result2->fetch_assoc()) { 
					?>
					<li><a href="?teamId=<?php echo $row["teamId"] ?>">
					<?php echo $row["teamName"]; ?> (5)</a></li>
					<?php
					}
					}
					else {
					echo "No results";
					}
					?> 
				</div></ul>
			</nav>
		</div>

		<div id="main-center">
			<?php
				if ($result->num_rows > 0) {
                //Output data of each row
                while($row = $result->fetch_assoc()) {
			?>
			<div class="hero-card">
				<div class="hero-card-img"><img src="img/heroes/<?php echo $row["heroImage"]; ?>" height="200" width="147"></div>
				<div class="hero-card-txt">
					<h3><?php echo $row["heroName"]; ?></h3>
					<p><?php echo $row["heroDescription"]; ?></p>
					<div id="infobtn"><a href="?heroId=<?php echo $row["heroId"]; ?>">More info</a></div>
				</div>
			</div>
			<?php
			}
			}
			if ($result->num_rows == 0) { 
			while($row3 = $result->fetch_assoc()) { ?>
			<div class="hero-card">
				<div class="hero-card-img"><img src="img/teams/<?php echo $row["teamImage"]; ?>" height="200" width="147"></div>
				<div class="hero-card-txt">
					<h3><?php echo $row["teamName"]; ?></h3>
					<p><?php echo $row["teamDescription"]; ?></p>
				</div>
			</div>
			<?php 
			}
			}
			?>
		</div>
    <div id="main-right">
<?php
        if(isset($heroId)) {
     ?>
      <?php
        while($row3 = $result3->fetch_assoc()) {
       ?>
        <div class="top-part">
          <div class="mid-part-image">
            <img class="hero-image-round" height="200px" width="130px;" src="img/heroes/<?php echo $row3["heroImage"]; ?>">
          </div>
          <h1 id="heroName"><?php echo $row3["heroName"]; ?></h1>
          <div class="info-box">
            <h2>Info</h2>
            <p>
            <?php echo $row3['heroDescription']; ?>
            </p>
            <h2>Powers</h2>
            <ul>
              <li><?php echo $row3['heroPower']; ?></li>
            </ul>
            <?php
              }
            ?>
          </div>
              <div class="review">
                <h4>Review</h4>
                <textarea class="text-area" rows="4" cols="50" name="comment" form="usrform">
Enter review here...</textarea>
              </div>
              <div class="divSubmit">
                <input type="submit" name="submitRating" value="Rate Hero"/>
                <input type="hidden" name="heroId" value="<?php echo $heroId; ?>"/>
              </div>
          </form>
          </div>

        </div>
        <?php
      } else {
        echo "No hero selected, please select one.";
      }
        ?>
  </div>
</div>
		</div>

		
</body>
</html>