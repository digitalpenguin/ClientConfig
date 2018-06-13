ClientConfig.window.Repeaters = function(config) {
    config = config || {};
    config.id = config.id || Ext.id(),
    Ext.applyIf(config, {
        title: _('clientconfig.edit_repeaters'),
        autoHeight: true,
        url: ClientConfig.config.connectorUrl,
        baseParams: {
            action: (config.isUpdate) ?
                'mgr/settings/update' :
                'mgr/settings/create'
        },
        width: 750,
        height: 600,
        fields: [{
            xtype: 'hidden',
            name: 'id'
        },{
            xtype: 'clientconfig-grid-repeaters'
        }]
    });
    ClientConfig.window.Repeaters.superclass.constructor.call(this,config);
};
Ext.extend(ClientConfig.window.Repeaters,MODx.Window);
Ext.reg('clientconfig-window-repeaters',ClientConfig.window.Repeaters);