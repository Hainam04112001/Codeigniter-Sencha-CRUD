Ext.define('ExtMVC.store.Contatos', {
    extend: 'Ext.data.Store',
    model: 'ExtMVC.model.Contato',
    autoLoad: true,
    pageSize: 35,
    autoLoad: {start: 0, limit: 35},
    
    proxy: {
        type: 'ajax',
        api: {
        	create: '/CodeIgniter-3.1.13/index.php/Contact/insert',
            read: '/CodeIgniter-3.1.13/index.php/Contact',
            update: '/CodeIgniter-3.1.13/index.php/Contact/update',
            destroy: '/CodeIgniter-3.1.13/index.php/Contact/delete',
        },
        reader: {
            type: 'json',
            root: 'contatos',
            successProperty: 'success'
        },
        writer: {
            type: 'json',
            writeAllFields: true,
            encode: true,
            root: 'contatos'
        }
    },
    // Function to filter by name
    filterByName: function(name) {
        this.clearFilter();
        if (name) {
            this.filter({
                filterFn: function(record) {
                    var recordName = record.get('name').toLowerCase();
                    return recordName.indexOf(name.toLowerCase()) !== -1;
                }
            });
        }
    }


});
