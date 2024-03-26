let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
let ajaxUrl = `${base_url}transparencia/getAnios`;
request.open('GET', ajaxUrl, true);
request.send();
request.onreadystatechange = function() {
    if (request.readyState == 4 && request.status == 200) {

        let objData = JSON.parse(request.responseText);
        if (objData.status) {

            let tabs = ''
            objData.data.map((year, index) => {
                const { anio } = year
                tabs += `<li class="nav-item" role="presentation">
                            <button class="nav-link ${(index === 0) ? 'active' : ''}" id="${anio}" data-bs-toggle="tab" data-bs-target="#tab${anio}" type="button" role="tab" aria-controls="${anio}" aria-selected="true"><i class="fa-solid fa-box-archive"></i> ${anio}</button>
                        </li>`
                        
                document.querySelector('#myTab').innerHTML = tabs
            })

            const container = document.querySelector('#myTab');
            container.addEventListener('click', data => {

                let anioSelected = +data.target.id;
                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                let ajaxUrl = `${base_url}transparencia/getFormato/${anioSelected}`;
                request.open('GET', ajaxUrl, true);
                request.send();
                request.onreadystatechange = function() {
                    if (request.readyState == 4 && request.status == 200) {
                        let objData = JSON.parse(request.responseText);
                        if (objData.status) {

                            let tabContent = `
                                <div class="tab-pane fade show active" id="tab${anioSelected}" role="tabpanel" aria-labelledby="tab${anioSelected}" tabindex="0">
                                    <div class="accordion" id="accordionExample">
                            `;

                            objData.data.map((data, i) => {

                                const { formato } = data

                                tabContent += `
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading${i}">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${i}" aria-expanded="true" aria-controls="collapse${i}">
                                                    ${formato}
                                                </button>
                                            </h2>
                                            <div id="collapse${i}" class="accordion-collapse collapse" aria-labelledby="heading${i}" data-bs-parent="#accordionExample">
                                                <div id="${formato}">
                                                </div>
                                            </div>
                                        </div>
                                `

                            })

                            tabContent += `
                                    </div>
                                </div>
                            `

                            document.querySelector('#myTabContent').innerHTML = tabContent;

                            const acordion = document.querySelector('#myTabContent');
                            acordion.addEventListener('click', data => {

                                let formato = data.target.innerText;
                                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                                let ajaxUrl = `${base_url}transparencia/getFileArticles/`;
                                let formData = new FormData();
                                formData.append('formato', formato);
                                formData.append('anio', anioSelected);
                                request.open('POST', ajaxUrl, true);
                                request.send(formData);
                                request.onreadystatechange = function() {
                                    if (request.readyState == 4 && request.status == 200) {
                                        let objData = JSON.parse(request.responseText);
                                        if (objData.status) {

                                            let bodyAcordion = `<div class="accordion-body">`;
                                            objData.data.map((data, i) => {
                                                
                                                const { filePDF, fileXLS, subtitulo } = data

                                                bodyAcordion += `
                                                    <div class="info">
                                                        <p><i class="fa-solid fa-file"></i> ${subtitulo}</p>
                                                        <div class="docs d-flex justify-content-center gap-3">
                                                            ${filePDF}
                                                            ${fileXLS}
                                                        </div>
                                                    </div>

                                                `

                                            })
                                            bodyAcordion += `</div>`;

                                            document.getElementById(formato).innerHTML = bodyAcordion
                                            
                                        }
                                    }
                                }

                            }); // subtitulo, filePDF, fileXLS

                        }
                    }
                }


            }); // Formato

        } else {
            // swal("Error", objData.msg, "error");
        }
    }
}