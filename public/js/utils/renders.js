// tutti i renders

const showAdvert = (annuncio) => {


    let type = 'Cerco';
    let cssTypeClass = 'success';

    if (annuncio.type === 'sell') {
        type = 'Vendo';
        cssTypeClass = 'danger';
    }

    let dataCreazione = new Date(annuncio.created_at);

    const options = { day: 'numeric', month: 'short', year: 'numeric' };
    const dataCreazioneFormattata = dataCreazione.toLocaleDateString('it-IT', options);

    return `
    <div class="annunci-card">
        <div class="ac-header">
            <span class="btn btn-${cssTypeClass} ac-type">${type}</span>
            <img src="https://picsum.photos/560/340" class="img-fluid" />
        </div>
        <div class="ac-content">
            <h4 class="mt-2">${annuncio.title}</h4>
            <span class="price">${annuncio.price} €</span>
            <p>${annuncio.body}</p>
        </div>
        <div class="ac-footer">
            <div class="row">
                <div class="col-6 text-center">${categorie[annuncio['category_id'] - 1].name}</div>
                <div class="col-6 text-center">${dataCreazioneFormattata}</div>
            </div>
        </div>
    </div>
    `;
}