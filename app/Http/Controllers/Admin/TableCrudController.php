<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TableRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TableCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TableCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Table::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/table');
        CRUD::setEntityNameStrings('mesa', 'mesas');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
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
            'label'     => 'Evento', // Table column headin
            'type'      => 'relationship',
            'name'      => 'event', // The db column name
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
        CRUD::setValidation(TableRequest::class);

        CRUD::addField([
            'name'      => 'name', // The db column name
            'label'     => 'Nombre', // Table column heading
            'wrapper'   => [
                'class' => 'form-group col-md-6'
            ],
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        if(request()->input("main_form_fields.0.value",NULL)){
            CRUD::addField([
                // 1-n relationship
                'label'     => 'Evento', // Table column heading
                'type'      => 'select',
                'name'      => 'event_id', // the column that contains the ID of that connected entity;
                'entity'    => 'event', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => "App\Models\Event", // foreign key model
                'wrapper'   => [
                    'class' => 'form-group col-md-6'
                ],
                'default' => request()->input("main_form_fields.0.value",NULL)
             ]);
        }
        else{
            CRUD::addField([
                // 1-n relationship
                'label'     => 'Evento', // Table column heading
                'type'      => 'select',
                'name'      => 'event_id', // the column that contains the ID of that connected entity;
                'entity'    => 'event', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => "App\Models\Event", // foreign key model
                'wrapper'   => [
                    'class' => 'form-group col-md-6'
                ],
                'default' => request()->get("event_id",NULL)
             ]);
        }
        

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
