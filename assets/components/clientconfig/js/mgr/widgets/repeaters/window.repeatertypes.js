ClientConfig.window.RepeaterTypes = function(config) {
    config = config || {};
    config.id = config.id || Ext.id(),
    Ext.applyIf(config, {
        title: _('clientconfig.edit_repeater_types'),
        width: 750,
        height: 600,
        fields: [{
            xtype: 'hidden',
            name: 'id'
        },{
            xtype: 'clientconfig-grid-repeatertypes'
        }]
    });
    ClientConfig.window.RepeaterTypes.superclass.constructor.call(this,config);
};
Ext.extend(ClientConfig.window.RepeaterTypes,MODx.Window);
Ext.reg('clientconfig-window-repeatertypes',ClientConfig.window.RepeaterTypes);