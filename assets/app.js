import Sortable from 'sortablejs';

document.addEventListener('DOMContentLoaded', () => {
    // Liste source (où les éléments sont clonés depuis)
    alert('test');
    new Sortable(document.getElementById('source-list'), {
        group: {
            name: 'shared',
            pull: 'clone', 
            put: false    
        },
        sort: false,       
        animation: 150
    });

    // Liste de destination (où les éléments clonés sont placés)
    new Sortable(document.getElementById('destination-list'), {
        group: {
            name: 'shared',
            pull: false, 
            put: true    
        },
        animation: 150,    
        onAdd: function (evt) {
            console.log('Élément ajouté à la liste de destination', evt.item);
        }
    });
});