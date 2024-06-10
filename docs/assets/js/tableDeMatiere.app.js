document.addEventListener('DOMContentLoaded', function() {
    const tableDeMatiere = document.getElementById('table-de-matiere');
    const h1AndH2Elements = document.querySelectorAll('h1, h2');

    const ul = document.createElement('ul');

    let pageNumber = 1;

    // Function to calculate page number based on element's position
    function calculatePageNumber(element) {
        const elementRect = element.getBoundingClientRect();
        const windowHeight = window.innerHeight;
        const scrollPosition = window.scrollY;
        const elementTop = elementRect.top + scrollPosition;
        const relativePosition = elementTop / windowHeight;
        return Math.ceil(relativePosition);
    }

    h1AndH2Elements.forEach(function (element) {
        // Check if the element is hidden
        const elementStyle = window.getComputedStyle(element);
        if (elementStyle.display === 'none') {
            return; // Skip hidden elements
        }

        const li = document.createElement('li');

        const newAnchor = document.createElement('a');
        newAnchor.href = "#" + element.id;
        newAnchor.textContent = element.textContent;
        newAnchor.style.fontWeight = "bold"; 

        li.appendChild(newAnchor);

        // Calculate page number dynamically
        const currentPageNumber = calculatePageNumber(element);

        const pageNumberSpan = document.createElement('span');
        pageNumberSpan.textContent = ' - Page ' + currentPageNumber;
        pageNumberSpan.style.marginLeft = '5px';
        li.appendChild(pageNumberSpan);

        if (element.tagName === 'H2') {
            newAnchor.style.fontSize = "15px";
            const innerUl = document.createElement('ul');
            innerUl.appendChild(li);
            ul.appendChild(innerUl);
        } else {
            newAnchor.style.fontSize = "18px";
            ul.appendChild(li);
        }
    });

    tableDeMatiere.insertAdjacentElement('afterend', ul);
});
