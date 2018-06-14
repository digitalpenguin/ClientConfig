ClientConfig.grid.RepeaterTypes = function(config) {
    config = config || {};
    Ext.applyIf(config,{
		url: ClientConfig.config.connectorUrl,
		id: 'clientconfig-grid-repeatertypes',
		baseParams: {
            action: 'mgr/repeaters/getlist'
        },
        save_action: 'mgr/repeaters/updatefromgrid',
        autosave: true,
        emptyText: _('clientconfig.error.noresults'),
		fields: [
            {name: 'id', type: 'int'},
            {name: 'key', type: 'string'},
            {name: 'label', type: 'string'},
            {name: 'description', type: 'string'},
            {name: 'sortorder', type: 'int'},
            {name: 'settings_count', type: 'int'}
        ],
        paging: true,
		remoteSort: true,
		columns: [{
			header: _('clientconfig.id'),
			dataIndex: 'id',
			sortable: true,
			width: .1
		},{
			header: _('clientconfig.label'),
			dataIndex: 'label',
			editor: { xtype: 'textfield' },
		    sortable: true,
			width: .3
		},{
			header: _('clientconfig.description'),
			dataIndex: 'description',
			editor: { xtype: 'textfield' },
			sortable: true,
			width: .5
		},{
			header: _('clientconfig.sortorder'),
			dataIndex: 'sortorder',
			editor: { 
			    xtype: 'numberfield', 
			    allowDecimal: false, 
			    allowNegative: false 
			},
			sortable: true,
			width: .1
		}],
        tbar: [{
            text: _('clientconfig.add_repeater_type'),
            handler: this.addRepeaterType,
            scope: this
        }]
    });
    ClientConfig.grid.RepeaterTypes.superclass.constructor.call(this,config);
};
Ext.extend(ClientConfig.grid.RepeaterTypes,MODx.grid.Grid,{
    addRepeaterType: function() {
        var win = MODx.load({
            xtype: 'clientconfig-window-repeatertype',
            listeners: {
                success: {fn: function(r) {
                    this.refresh();
                },scope: this},
                scope: this
            }
        });
        win.show();
    },
    updateRepeaterType: function() {
        var record = this.menu.record;
        var win = MODx.load({
            xtype: 'clientconfig-window-repeatertype',
            listeners: {
                success: {fn: function(r) {
                    this.refresh();
                },scope: this},
                scope: this
            },
            isUpdate: true
        });
        win.setValues(record);
        win.show();
    },
    removeRepeaterType: function() {
        var id = this.menu.record.id;
        MODx.msg.confirm({
            title: _('clientconfig.remove_repeater'),
            text: _('clientconfig.remove_repeater.confirm'),
            url: this.config.url,
            params: {
                action: 'mgr/repeaters/remove',
                id: id
            },
            listeners: {
                success: {fn: function(r) {
                    this.refresh();
                },scope: this},
                scope: this
            }
        });
    },
    getMenu: function(node) {
        var m = [];

        m.push({
            text: _('clientconfig.update_repeater_type'),
            handler: this.updateRepeaterType,
            scope: this
        },'-',{
            text: _('clientconfig.remove_repeater_type'),
            handler: this.removeRepeaterType,
            scope: this
        });
        return m;
    }
});
Ext.reg('clientconfig-grid-repeatertypes',ClientConfig.grid.RepeaterTypes);
