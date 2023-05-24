<?php

return array(

	'Global' => array(
		array(
			'permission' => 'superuser',
			'label'      => 'Super User',
		),
	),

	'Admin' => array(
		array(
			'permission' => 'admin',
			'label'      => 'Admin Rights',
		),
	),

	'Account Management-> Payment Verify' => array(
		array(
			'permission' => 'payment-veriy.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'payment-veriy.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'payment-veriy.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'payment-veriy.delete',
			'label'      => 'Delete',
		),
	),

	'Account Management-> General Voucher' => array(
		array(
			'permission' => 'general-voucher.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'general-voucher.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'general-voucher.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'general-voucher.delete',
			'label'      => 'Delete',
		),
	),

	'Account Management-> Unapproved Voucher' => array(
		array(
			'permission' => 'general-voucher.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'general-voucher.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'general-voucher.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'general-voucher.delete',
			'label'      => 'Delete',
		),
	),

	'Account Management-> Credit Limit Management(Agent)' => array(
		array(
			'permission' => 'c-l-m-agent.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'c-l-m-agent.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'c-l-m-agent.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'c-l-m-agent.delete',
			'label'      => 'Delete',
		),
	),
	'Account Management-> Credit Limit Management(Branch Office)' => array(
		array(
			'permission' => 'c-l-m-bo.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'c-l-m-bo.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'c-l-m-bo.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'c-l-m-bo.delete',
			'label'      => 'Delete',
		),
	),

	'Account Management-> Credit Limit Management(Distributor)' => array(
		array(
			'permission' => 'c-l-m-db.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'c-l-m-db.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'c-l-m-db.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'c-l-m-db.delete',
			'label'      => 'Delete',
		),
	),

	'Account Management-> Service Provider Settings' => array(
		array(
			'permission' => 's-p-s.view',
			'label'      => 'View',
		),
		array(
			'permission' => 's-p-s.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 's-p-s.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 's-p-s.delete',
			'label'      => 'Delete',
		),
	),

	'Reports-> Branch Office Ledger Transaction' => array(
		array(
			'permission' => 'b-o-ledger-transaction.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'b-o-ledger-transaction.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'b-o-ledger-transaction.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'b-o-ledger-transaction.delete',
			'label'      => 'Delete',
		),
	),

	'Reports-> Distributor Ledger Transaction' => array(
		array(
			'permission' => 'db-ledger-transaction.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'db-ledger-transaction.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'db-ledger-transaction.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'db-ledger-transaction.delete',
			'label'      => 'Delete',
		),
	),

	'Reports-> Agent Ledger Transaction' => array(
		array(
			'permission' => 'agent-ledger-transaction.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'agent-ledger-transaction.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'agent-ledger-transaction.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'agent-ledger-transaction.delete',
			'label'      => 'Delete',
		),
	),

	'Reports-> Agent Available Balance' => array(
		array(
			'permission' => 'agent-available-balance.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'agent-available-balance.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'agent-available-balance.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'agent-available-balance.delete',
			'label'      => 'Delete',
		),
	),

	'Reports-> Login History' => array(
		array(
			'permission' => 'login-history.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'login-history.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'login-history.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'login-history.delete',
			'label'      => 'Delete',
		),
	),

	'Reports-> Ledger Transaction Summary' => array(
		array(
			'permission' => 'l-t-s.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'l-t-s.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'l-t-s.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'l-t-s.delete',
			'label'      => 'Delete',
		),
	),

	'System Setup-> Application Settings' => array(
		array(
			'permission' => 'application-settings.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'application-settings.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'application-settings.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'application-settings.delete',
			'label'      => 'Delete',
		),
	),

	'System Setup-> FX Rate Settings' => array(
		array(
			'permission' => 'fx-rate-settings.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'fx-rate-settings.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'fx-rate-settings.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'fx-rate-settings.delete',
			'label'      => 'Delete',
		),
	),

	'System Setup-> Branch Office Management' => array(
		array(
			'permission' => 'b-o-m.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'b-o-m.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'b-o-m.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'b-o-m.delete',
			'label'      => 'Delete',
		),
	),

	'User Management' => array(
		array(
			'permission' => 'user-management.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'user-management.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'user-management.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'user-management.delete',
			'label'      => 'Delete',
		),
	),

	'User Management-> Role Management' => array(
		array(
			'permission' => 'role-management.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'role-management.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'role-management.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'role-management.delete',
			'label'      => 'Delete',
		),
	),

	'Agent Management' => array(
		array(
			'permission' => 'agent-management.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'agent-management.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'agent-management.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'agent-management.delete',
			'label'      => 'Delete',
		),
	),

	'Manager Management' => array(
		array(
			'permission' => 'manager-management.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'manager-management.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'manager-management.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'manager-management.delete',
			'label'      => 'Delete',
		),
	),

	'B2C-> Users List' => array(
		array(
			'permission' => 'users-list.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'users-list.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'users-list.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'users-list.delete',
			'label'      => 'Delete',
		),
	),

	'General Settings-> Slider Management' => array(
		array(
			'permission' => 'gs-slider-management.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'gs-slider-management.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'gs-slider-management.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'gs-slider-management.delete',
			'label'      => 'Delete',
		),
	),

	'General Settings-> News Management' => array(
		array(
			'permission' => 'gs-news-management.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'gs-news-management.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'gs-news-management.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'gs-news-management.delete',
			'label'      => 'Delete',
		),
	),

	'General Settings-> Newsletter Management' => array(
		array(
			'permission' => 'gs-newsletter-management.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'gs-newsletter-management.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'gs-newsletter-management.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'gs-newsletter-management.delete',
			'label'      => 'Delete',
		),
	),

	'General Settings-> Menu Management' => array(
		array(
			'permission' => 'gs-menu-management.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'gs-menu-management.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'gs-menu-management.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'gs-menu-management.delete',
			'label'      => 'Delete',
		),
	),

	'General Settings-> Comments Management' => array(
		array(
			'permission' => 'gs-comments-management.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'gs-comments-management.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'gs-comments-management.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'gs-comments-management.delete',
			'label'      => 'Delete',
		),
	),

	'Airlines-> New Bookings, Booking List' => array(
		array(
			'permission' => 'airlines.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'airlines.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'airlines.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'airlines.delete',
			'label'      => 'Delete',
		),
	),

    'Airlines-> Flight Airlines' => array(
		array(
			'permission' => 'airlines-list.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'airlines-list.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'airlines-list.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'airlines-list.delete',
			'label'      => 'Delete',
		),
	),

	'Airlines-> Flight Airports' => array(
		array(
			'permission' => 'airports-list.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'airports-list.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'airports-list.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'airports-list.delete',
			'label'      => 'Delete',
		),
	),

	'Airlines-> Deal Setup' => array(
		array(
			'permission' => 'airlines-deal-setup.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'airlines-deal-setup.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'airlines-deal-setup.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'airlines-deal-setup.delete',
			'label'      => 'Delete',
		),
	),

	'Airlines-> Paper Fare' => array(
		array(
			'permission' => 'airlines-paper-fare.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'airlines-paper-fare.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'airlines-paper-fare.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'airlines-paper-fare.delete',
			'label'      => 'Delete',
		),
	),

	 'Orders' => array(
		array(
			'permission' => 'orders.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'orders.create',
			'label'      => 'Create',
		),
		array(
			'permission' => 'orders.edit',
			'label'      => 'Edit',
		),
		array(
			'permission' => 'orders.delete',
			'label'      => 'Delete',
		),
	),
    
    'Package Tours' => array(
      array(
			'permission' => 'packagetours_view',
			'label'      => 'View',
		),
		array(
			'permission' => 'packagetours_create',
			'label'      => 'Create',
		),
        array(
			'permission' => 'packagetours_edit',
			'label'      => 'Edit',
		),
        array(
			'permission' => 'packagetours_delete',
			'label'      => 'Delete',
		),
                
	),
    
    'Hotels' => array(
                array(
			'permission' => 'hotels_view',
			'label'      => 'View',
		),
		array(
			'permission' => 'hotels_create',
			'label'      => 'Create',
		),
        array(
			'permission' => 'hotels_edit',
			'label'      => 'Edit',
		),
        array(
			'permission' => 'hotels_delete',
			'label'      => 'Delete',
		),
                
	),
    
    'Vacation Rentals' => array(
        array(
			'permission' => 'vacationrentals_view',
			'label'      => 'View',
		),
		array(
			'permission' => 'vacationrentals_create',
			'label'      => 'Create',
		),
        array(
			'permission' => 'vacationrentals_edit',
			'label'      => 'Edit',
		),
        array(
			'permission' => 'vacationrentals_delete',
			'label'      => 'Delete',
		),
                
	),
    
    'Vehicle Rentals' => array(
                array(
			'permission' => '_view',
			'label'      => 'View',
		),
		array(
			'permission' => 'vehiclerentals_create',
			'label'      => 'Create',
		),
        array(
			'permission' => 'vehiclerentals_edit',
			'label'      => 'Edit',
		),
        array(
			'permission' => 'vehiclerentals_delete',
			'label'      => 'Delete',
		),
                
	),

  'Payment Gateways' => array(
                array(
			'permission' => 'payment-gateways.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'payment-gateways.create',
			'label'      => 'Create',
		),
        array(
			'permission' => 'payment-gateways.edit',
			'label'      => 'Edit',
		),
        array(
			'permission' => 'payment-gateways.delete',
			'label'      => 'Delete',
		),
                
	),

	'Payment Gateways' => array(
                array(
			'permission' => 'payment-gateways.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'payment-gateways.create',
			'label'      => 'Create',
		),
        array(
			'permission' => 'payment-gateways.edit',
			'label'      => 'Edit',
		),
        array(
			'permission' => 'payment-gateways.delete',
			'label'      => 'Delete',
		),
                
	),

	'Domestic Flight Commission' => array(
                array(
			'permission' => 'domestic-flight-commission.view',
			'label'      => 'View',
		),
		array(
			'permission' => 'domestic-flight-commission.create',
			'label'      => 'Create',
		),
        array(
			'permission' => 'domestic-flight-commission.edit',
			'label'      => 'Edit',
		),
        array(
			'permission' => 'domestic-flight-commission.delete',
			'label'      => 'Delete',
		),
                
	),

   
         
    
);
