<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GuestRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class GuestCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class GuestCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Guest::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/guest');
        CRUD::setEntityNameStrings('invitado', 'invitados');
        CRUD::addButtonFromView('line', 'copyLink', 'guest.link', 'beginning');
        $this->crud->disableResponsiveTable();
        $this->crud->enableExportButtons();

    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::disableResponsiveTable();

        if(request()->get('event_id')){
            CRUD::addClause('where', 'event_id', '=', request()->get('event_id'));
            CRUD::addButtonFromView('top', 'return', 'return', 'beginning');
        }

        CRUD::addColumn([
            'name'      => 'name', // The db column name
            'label'     => 'Nombre', // Table column heading
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        CRUD::addColumn([
            'name'      => 'phone', // The db column name
            'label'     => 'Teléfono', // Table column heading
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        CRUD::addColumn([
            'name'      => 'email', // The db column name
            'label'     => 'E-mail', // Table column heading
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        CRUD::addColumn([
            'name'      => 'tickets', // The db column name
            'label'     => 'Tickets', // Table column heading
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        CRUD::addColumn([
            'name'      => 'confirmed_tickets', // The db column name
            'label'     => 'Tickets confirmados', // Table column heading
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        CRUD::addColumn([
            'label'     => 'Mesa', // Table column headin
            'type'      => 'relationship',
            'name'      => 'table', // The db column name
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        CRUD::addColumn([
            'name'      => 'confirmed_at', // The db column name
            'label'     => 'Fecha de Confirmación', // Table column heading
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        CRUD::addColumn([
            'label'     => 'Menu', // Table column headin
            'type'      => 'relationship',
            'name'      => 'menu', // The db column name
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        CRUD::addColumn([
            'label'     => 'Evento', // Table column headin
            'type'      => 'relationship',
            'name'      => 'event', // The db column name
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        CRUD::addColumn([
            'label'     => 'Estatus', // Table column headin
            'type'      => 'relationship',
            'name'      => 'status', // The db column name
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        
        
        CRUD::addColumn([
            'name'      => 'message', // The db column name
            'label'     => 'Mensaje para los novios', // Table column heading
            'escaped' => false,
            // 'limit'  => -1, // character limit; default is 50;
            
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);


        CRUD::addColumn([
            'name'      => 'comments', // The db column name
            'label'     => 'Comentario', // Table column heading
            'escaped' => false,
            // 'limit'  => -1, // character limit; default is 50;
            
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(GuestRequest::class);

        // CRUD::setFromDb(); // fields

        CRUD::addField([
            'name'      => 'name', // The db column name
            'label'     => 'Nombre', // Table column heading
            'wrapper'   => [
                'class' => 'form-group col-md-4'
            ],
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        CRUD::addField([
            'name'      => 'phone', // The db column name
            'label'     => 'Teléfono', // Table column heading
            'wrapper'   => [
                'class' => 'form-group col-md-4'
            ],
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        CRUD::addField([
            'name'      => 'email', // The db column name
            'label'     => 'E-mail', // Table column heading
            'type'      => 'email',
            'wrapper'   => [
                'class' => 'form-group col-md-4'
            ],
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        CRUD::addField([
            'name'      => 'tickets', // The db column name
            'label'     => 'Tickets', // Table column heading
            'type'      => 'number',
            'wrapper'   => [
                'class' => 'form-group col-md-4'
            ],
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        CRUD::addField([
            'name'      => 'confirmed_tickets', // The db column name
            'label'     => 'Tickets confirmados', // Table column heading
            'type'      => 'number',
            'wrapper'   => [
                'class' => 'form-group col-md-4'
            ],
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        CRUD::addField([
            'name'      => 'confirmed_at', // The db column name
            'label'     => 'Fecha de Confirmación', // Table column heading
            'type'      => 'date',
            'wrapper'   => [
                'class' => 'form-group col-md-4'
            ],
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        CRUD::addField([
            // 1-n relationship
            'label'     => 'Evento', // Table column heading
            'type'      => 'select',
            'name'      => 'event_id', // the column that contains the ID of that connected entity;
            'entity'    => 'event', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => "App\Models\Event", // foreign key model
            'wrapper'   => [
                'class' => 'form-group col-md-4'
            ],
            'default' => request()->get("event_id",NULL)
         ]);

        CRUD::addField([
            // 1-n relationship
            'label'     => 'Mesa', // Table column heading
            'type'      => 'select',
            'name'      => 'table_id', // the column that contains the ID of that connected entity;
            'entity'    => 'table', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => "App\Models\Table", // foreign key model
            'wrapper'   => [
                'class' => 'form-group col-md-4'
            ],
         ]);

        CRUD::addField([
            // 1-n relationship
            'label'     => 'Estatus', // Table column heading
            'type'      => 'select',
            'name'      => 'guest_status_id', // the column that contains the ID of that connected entity;
            'entity'    => 'status', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => "App\Models\GuestStatus", // foreign key model
            'wrapper'   => [
                'class' => 'form-group col-md-4'
            ],
            'default' => '3'
         ]);

        CRUD::addField([
            'name'      => 'message', // The db column name
            'label'     => 'Mensaje para los novios', // Table column heading
            'type' => 'wysiwyg',
            'escaped' => false,
            'limit'  => -1, // character limit; default is 50;
            
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);
        
        CRUD::addField([
            'name'      => 'comments', // The db column name
            'label'     => 'Comentario', // Table column heading
            'type' => 'wysiwyg',
            'escaped' => false,
            'limit'  => -1, // character limit; default is 50;
            
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
