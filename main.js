async function load() {
    let modal = document.querySelector(".modal")
    modal.classList.add("show")
    console.log(modal)


    const spinner = document.getElementById('spinner')
    spinner?.classList.remove('d-none')

    const data = await fetch('/main/parser.php').then(response => response.json())

    console.log(data)

    const content = document.getElementById('content')


    if (data?.data) {
        //todo очистить content
        data?.data?.forEach(el => {

            let block = `<div class="album py-5 bg-light">
                        <div class="container">
                           <div id="content" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        <div class="col">
                        <div class="card shadow-sm h-100">
                            <img alt="${el.heading}" class="bd-placeholder-img card-img-top" width="100%" height="250px" src="${el.image}">
                            <div class="card-body">
                                <h2 class="card-text">${el.heading}</h2>
                                <p class="card-text">${el.description}<a href="https://rutgersaaup.org/faculty-students-and-staff-stand-together-for-rutgers-camden/" rel="noopener nofollow" target="_blank"><u>press release</u></a>.</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3 mx-3">
                                <small class="text-muted">${el.sort_date}</small>
                                <div class="d-flex pl-3 pt-1">
                                    <a href="updateForm.php?id=1629" class="btn btn-warning mx-2" id="update">Edit</a>
                                    <a href="delete.php?delete=1&amp;delete_id=1629" class="btn btn-danger" id="delete">Delete</a>
                                </div>
                            </div>
                        </div> 
                             </div>
                            </div>
                        </div>                     
                    </div>`
                    document.getElementById("content").insertAdjacentHTML("beforeBegin", block);


        })
    }

    spinner?.classList.add('d-none')
}
