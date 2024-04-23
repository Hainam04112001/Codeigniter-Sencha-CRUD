Ext.define('ExtMVC.view.contato.Grid' ,{
    extend: 'Ext.grid.Panel',
    alias : 'widget.contatogrid',
    
    requires: ['Ext.toolbar.Paging'],
    
    iconCls: 'icon-grid',

    title : 'Contatos',
    store: 'Contatos',

    columns: [{
    	header: "NAME",
		width: 170,
		flex:1,
		dataIndex: 'name'
	},{
		header: "TELEFONE",
		width: 160,
		flex:1,
		dataIndex: 'phone'
	},{
		header: "EMAIL",
		width: 170,
		flex:1,
		dataIndex: 'email'
	}],
	
	initComponent: function() {
		
		this.dockedItems = [{
            xtype: 'toolbar',
            items: [{
                iconCls: 'icon-save',
                itemId: 'add',
                text: 'Adicionar',
                action: 'add'
            },{
                iconCls: 'icon-delete',
                text: 'Excluir',
                action: 'delete'
            }]
        },
        {
            xtype: 'pagingtoolbar',
            dock:'top',
            store: 'Contatos',
            displayInfo: true,
            displayMsg: 'Mostrando Contatos {0} - {1} de {2}',
            emptyMsg: "Nenhum contato encontrado."
        },
        {
            xtype: 'toolbar',
            dock: 'top',
            items: [
                {
                    xtype: 'textfield',
                    fieldLabel: 'Filter by Name',
                    labelWidth: 100,
                    listeners: {
                        change: function(field, newValue) {
                            var contatoStore = Ext.getStore('Contatos');
                            contatoStore.clearFilter();
                            if (newValue) {
                                contatoStore.filter({
                                    filterFn: function(record) {
                                        var recordName = record.get('name').toLowerCase();
                                        return recordName.indexOf(newValue.toLowerCase()) !== -1;
                                    }
                                });
                            }
                        }
                    }
                },
                {
                    text: 'Clear Filters',
                    handler: function() {
                        var contatoStore = Ext.getStore('Contatos');
                        contatoStore.clearFilter();
                    }
                }
            ]
        }
    
    
    ];
		
		this.callParent(arguments);
	}
});
