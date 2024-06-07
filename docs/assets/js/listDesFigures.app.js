/**
 * List des figures
 */
const listDesFiguresElement = document.getElementById('list-des-figures');
const figureElements = document.querySelectorAll('em');
const ulElement = document.createElement('ul'); 

let pageNumber = 1; 

figureElements.forEach(function (figure) {

    const li = document.createElement('li');

    const newAnchor = document.createElement('a');
    newAnchor.href = "#" + figure.id;
    newAnchor.textContent = figure.textContent; 
    newAnchor.style.fontWeight = "bold"; 

    li.appendChild(newAnchor);


    if (figure.offsetTop > pageNumber * window.innerHeight) {
        pageNumber++; 
    }

    const pageNumberSpan = document.createElement('span');
    pageNumberSpan.textContent = ' - Page ' + pageNumber;
    pageNumberSpan.style.marginLeft = '5px';
    li.appendChild(pageNumberSpan);

    ulElement.appendChild(li); 

});

listDesFiguresElement.insertAdjacentElement('afterend', ulElement);
