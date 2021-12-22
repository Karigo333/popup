function getNews() {


    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200)
            // document.getElementById("mydiv").innerHTML = xhttp.response;
            localStorage.setItem('xhttp', xhttp.response);
            const getItem = localStorage.getItem('xhttp');
            const a = JSON.parse(getItem);
            console.log(a);
    }

    xhttp.open("GET", "Router.php?action=get-articles", true);
    xhttp.send();
}
getNews();





async function checkPosition() {

    const height = document.body.offsetHeight
    const screenHeight = window.innerHeight
    const scrolled = window.scrollY
    const threshold = height - screenHeight / 4
    const position = scrolled + screenHeight

    if (position >= threshold) {
    }
    ;(() => {
        window.addEventListener("scroll", checkPosition)
        window.addEventListener("resize", checkPosition)
    })()


}




function changeToRow() {



    const myStorage = localStorage.getItem('xhttp');
    const a = JSON.parse(myStorage);

    const div = [];



    a.news.forEach(el => {

        const id = el.id;
        const heading = el.heading;
        const description = el.description;
        const image = el.image;
        const sortData = el.sort_date;
        const data = sortData.replace(/-/g, '.');



        const chBlock = `
        <div id="content">
                    <div  class="row">
                        <div class="col-sm-4" style="background-image: url(${image}); min-width: 30%;height: 300px; background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
                            <div class="card-body col-sm-8">
                                <h2 class="card-text">${heading}</h2>
                                <p class="card-text">${description}</p>
                                <small class="text-muted">${data}</small>
                                <div class="d-flex pt-1">
                                <div class="d-flex pl-3 pt-1">
                                    <a href="updateForm.php?id=${id}"
                                       class="btn btn-warning mx-2 edit" id="update">Edit</a>
                                    <a href="delete.php?delete=1&delete_id=${id}"
                                       class="btn btn-danger del" id="delete">Delete</a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>`;

        div.push(chBlock);
    })

    document.getElementById("mydiv").innerHTML = div.join('<br>')
}


async function load() {

    let modal = document.querySelector(".modal")
    modal.classList.add("show")

    const modalBody = document.querySelector('.modal .modal-body')
    modalBody.innerHTML = `
        <div id="spinner" class="d-flex justify-content-center text-primary" style="min-height: 60vh; align-items: center; background-color: rgba(,0,255,.1)">
            <div class="spinner-border" role="status">
                <span class="sr-only"></span>
            </div>
        </div>
    `;
    const spinner = document.getElementById('spinner')

    const data = await fetch('/main/parser.php').then(response => response.json())
    const div = [];
    if (data?.data?.length > 0) {
        data?.data?.forEach(el => {
            const block = `
                            <img alt="${el.heading}" class="bd-placeholder-img card-img-top" width="100%" height="250px" src="${el.image}">
                            <div class="card-body">
                                <h2 class="card-text">${el.heading}</h2>
                                <p class="card-text">${el.description}</p>
                            </div>
                            <small class="text-muted">${el.data}</small>
            `;

            div.push(block);
        })
    } else {
        div.push(`<p>Nothing parse</p>`);
    }
    modalBody.innerHTML = div.join('<br>');
    spinner?.classList.add('d-none')
}

function changeToList() {


    const myStorage = localStorage.getItem('xhttp');
    const a = JSON.parse(myStorage);
    const div = [];


    const chBlock1 = `
        <div id="content" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
`;
    const chBlock2 = `</div>`;
    div.push(chBlock1);

    a.news.forEach(el => {

        const id = el.id;
        const heading = el.heading;
        const description = el.description;
        const image = el.image;
        const sortData = el.sort_date;
        const data = sortData.replace(/-/g, '.');

        const chBlock = `
                    <div class="col">
                            <div id="editimg" class="card shadow-sm h-100">
                                 <div style="background-image: url('${image}'); min-width: 30%;height: 300px; background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
                                      <div class="card-body">
                                          <h2 class="card-text">${heading}</h2>
                                          <p class="card-text">${description}</p>
                                      </div>
                                      <div class="d-flex justify-content-between align-items-center mb-3 mx-3">
                                         <small class="text-muted">${data}</small>
                                             <div class="d-flex pl-3 pt-1">
                                                <a href="updateForm.php?id=${id}" class="btn btn-warning mx-2 edit" id="update">Edit</a>
                                                <a href="delete.php?delete=1&delete_id=${id}" class="btn btn-danger del" id="delete">Delete</a>
                                           </div>
                                        </div>
                                    </div>
                                    </div>
                             `;

        div.push(chBlock);
    })

    div.push(chBlock2);
    document.getElementById("mydiv").innerHTML = div.join('')

}



