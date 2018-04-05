function random_ad() {

//create an array of the ad images that we will be using

var adArray = new Array()

adArray[0] = "/images/ads/agrilife.png"
adArray[1] = "/images/ads/natimes.png"
adArray[2] = "/images/ads/sapling.png"
adArray[3] = "/images/ads/argentmedia.png"
adArray[4] = "/images/ads/maxwell.png"
adArray[5] = "/images/ads/onebyone.png"
adArray[6] = "/images/ads/petpsychic.png"
adArray[7] = "/images/ads/misscleo.png"
adArray[8] = "/images/ads/madamfortune.png"
adArray[9] = "/images/ads/anna.png"
adArray[10] = "/images/ads/fortune.png"
adArray[11] = "/images/ads/psychic.png"
adArray[12] = "/images/ads/monique.png"
adArray[13] = "/images/ads/amgalitzin.png"
adArray[14] = "/images/ads/redsector.png"
adArray[15] = "/images/ads/nutridyne.png"
adArray[16] = "/images/ads/partyblimp.png"
adArray[17] = "/images/ads/castlevania.png"


//chose a random number that is within the bounds of the length of the image array

var i = Math.floor(Math.random()*adArray.length)

//write the image html for the image display
document.write('<img src="'+adArray[i]+'" class="img-ads" >')
}