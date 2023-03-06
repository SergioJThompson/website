const logos = ["/images/logos/logo-corporate-big.png", "/images/logos/logo-medieval.jpg"]
const randomNumber = Math.floor(Math.random() * logos.length);
const logoImg = document.getElementById("logo-img");
logoImg.src = logos[randomNumber];
