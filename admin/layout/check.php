<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Image Overlay on Hover</title>
<style>
.img-container {
  position: relative;
  display: inline-block;
}

.img-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); 
  opacity: 0; 
  transition: opacity 0.3s ease;
}

.img-container:hover .img-overlay {
  opacity: 1;
}

.img-container img {
  display: block;
  width: 100%;
  height: auto;
}
</style>
</head>
<body>

<div class="img-container">
  <img src="https://via.placeholder.com/300x200" alt="Sample Image">
  <div class="img-overlay"></div>
</div>

</body>
</html>
