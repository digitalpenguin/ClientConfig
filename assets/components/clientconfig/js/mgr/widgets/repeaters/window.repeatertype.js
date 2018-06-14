ClientConfig.window.RepeaterType = function(config) {
    config = config || {};
    config.id = config.id || Ext.id(),

    Ext.applyIf(config,{
        title: (config.isUpdate) ?
            _('clientconfig.update_repeater_type') :
            (config.isDuplicate) ? _('clientconfig.duplicate_repeater_type') : _('clientconfig.add_repeater_type'),
        autoHeight: true,
        url: ClientConfig.config.connectorUrl,
        baseParams: {
            action: (config.isUpdate) ?
                'mgr/repeaters/update' :
                'mgr/repeaters/create'
        },
        fields: [{
            xtype: 'hidden',
            name: 'id'
        },{
            xtype: 'textfield',
            name: 'key',
            fieldLabel: _('clientconfig.key') + '*',
            allowBlank: false,
            anchor: '100%'
        },{
            xtype: 'textfield',
            name: 'label',
            fieldLabel: _('clientconfig.label') + '*',
            allowBlank: false,
            anchor: '100%'
        },{
            xtype: 'textarea',
            name: 'description',
            fieldLabel: _('clientconfig.description'),
            anchor: '100%'
        }],
        keys: [] //prevent enter from firing submit
    });
    ClientConfig.window.RepeaterType.superclass.constructor.call(this,config);
};
Ext.extend(ClientConfig.window.RepeaterType,MODx.Window);
Ext.reg('clientconfig-window-repeatertype',ClientConfig.window.RepeaterType);
