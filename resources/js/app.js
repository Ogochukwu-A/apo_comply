import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import EmblaCarousel from 'embla-carousel';
import Autoplay from 'embla-carousel-autoplay';

// const embla = EmblaCarousel(emblaRoot, { loop: false }, [Autoplay()]); // Add plugin

// Grab wrapper nodes
const rootNode = document.querySelector('.embla')
const viewportNode = rootNode.querySelector('.embla__viewport')

// Grab button nodes
const prevButtonNode = rootNode.querySelector('.embla__prev')
const nextButtonNode = rootNode.querySelector('.embla__next')

    
// Initialize the carousel

const autoplayOptions = {
  delay: 4000,
  rootNode: (emblaRoot) => emblaRoot.parentElement,
}

const embla = EmblaCarousel(viewportNode, { loop: false }, [
  Autoplay(autoplayOptions), // Add plugin with options
])

// Add click listeners
prevButtonNode.addEventListener('click', embla.scrollPrev, false)
nextButtonNode.addEventListener('click', embla.scrollNext, false)


// partners starts here 
const OPTIONS = { slidesToScroll: 'auto', containScroll: 'trimSnaps' }

const emblaNode_partners = document.querySelector('.embla')
const viewportNode_partners = emblaNode_partners.querySelector('.embla__viewport')

// @ts-ignore

const emblaApi = EmblaCarousel(viewportNode_partners, OPTIONS)
// partners ends here


// Get the button
var mybutton = document.getElementById("goToTopBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {
  scrollFunction();
};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
mybutton.addEventListener("click", function() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera
});
