const sideLinks = document.querySelectorAll('.sidebar .side-menu li a:not(.logout)');

sideLinks.forEach(item => {
    const li = item.parentElement;
    item.addEventListener('click', () => {
        sideLinks.forEach(i => {
            i.parentElement.classList.remove('active');
        })
        li.classList.add('active');
    })
});

const menuBar = document.querySelector('.content nav .bx.bx-menu');
const sideBar = document.querySelector('.sidebar');

menuBar.addEventListener('click', () => {
    sideBar.classList.toggle('close');
});

const searchBtn = document.querySelector('.content nav form .form-input button');
const searchBtnIcon = document.querySelector('.content nav form .form-input button .bx');
const searchForm = document.querySelector('.content nav form');

searchBtn.addEventListener('click', function (e) {
    if (window.innerWidth < 576) {
        e.preventDefault;
        searchForm.classList.toggle('show');
        if (searchForm.classList.contains('show')) {
            searchBtnIcon.classList.replace('bx-search', 'bx-x');
        } else {
            searchBtnIcon.classList.replace('bx-x', 'bx-search');
        }
    }
});

window.addEventListener('resize', () => {
    if (window.innerWidth < 768) {
        sideBar.classList.add('close');
    } else {
        sideBar.classList.remove('close');
    }
    if (window.innerWidth > 576) {
        searchBtnIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
});

const toggler = document.getElementById('theme-toggle');

toggler.addEventListener('change', function () {
    if (this.checked) {
        document.body.classList.add('dark');
    } else {
        document.body.classList.remove('dark');
    }
});


function formulaire_artiste(){
    var formulaire = document.getElementById("formulaire_ajouter_artiste");
    formulaire.style.display = "block";
}

function formulaire_membre(){
    var formulaire = document.getElementById("formulaire_ajouter_membre");
    formulaire.style.display = "block";
}

function cancel_formulaire_membre(){
    var formulaire = document.getElementById("formulaire_ajouter_membre");
    formulaire.style.display = "none";
}

function cancel_formulaire_artiste(){
    var formulaire = document.getElementById("formulaire_ajouter_artiste");
    formulaire.style.display = "none";
}



// filtre 

const optionsMenu = document.querySelector(".filter");
const Btn = document.querySelector(".filter-btn");
const optionsfilter = document.querySelectorAll(".option_filtre");
const sBtn = document.querySelector(".sBtn-text");
Btn.addEventListener("click",()=> optionsMenu.classList.toggle("active"));

optionsfilter.forEach(optionparking => {
    optionparking.addEventListener("click", ()=>{
        let selectedOption= optionparking.querySelector(".option-text").innerHTML;
        sBtn.innerHTML = selectedOption;
        optionsMenu.classList.remove("active");
    })
});