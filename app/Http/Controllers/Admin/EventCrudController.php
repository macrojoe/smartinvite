<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EventRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class EventCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EventCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Event::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/event');
        CRUD::setEntityNameStrings('evento', 'eventos');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::setFromDb(); // columns

        CRUD::addColumn([
            'name'      => 'name', // The db column name
            'label'     => 'Nombre', // Table column heading
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);
        
        CRUD::addColumn([
            'name'      => 'date', // The db column name
            'label'     => 'Fecha', // Table column heading
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
            'label'     => 'Imagen', // Table column headin
            'type'      => 'image',
            'name'      => 'image', // The db column name
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        CRUD::addColumn([
            'name'      => 'comments', // The db column name
            'label'     => 'Comentarios', // Table column heading
            'escaped' => false,
            // 'limit'  => -1, // character limit; default is 50;
            
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        CRUD::addColumn([
            'name'      => 'user', // The db column name
            'type'      => 'relationship',
            'label'     => 'Creado por', // Table column headin
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
        CRUD::setValidation(EventRequest::class);

        // CRUD::setFromDb(); // fields

        CRUD::addField([
            'name'      => 'name', // The db column name
            'label'     => 'Nombre', // Table column heading
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);
        
        CRUD::addField([
            'name'      => 'date', // The db column name
            'label'     => 'Fecha', // Table column heading
            'type'      => 'datetime'
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        CRUD::addField([
            // 1-n relationship
            'label'     => 'Estatus', // Table column heading
            'type'      => 'select',
            'name'      => 'event_status_id', // the column that contains the ID of that connected entity;
            'entity'    => 'status', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => "App\Models\EventStatus", // foreign key model
            'default' => request()->get("event_status_id",NULL)
         ]);

        CRUD::addField([
            'label'     => 'Imagen', // Table column headin
            'type'      => 'image',
            'name'      => 'image', // The db column name
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        CRUD::addField([
            'name'      => 'comments', // The db column name
            'label'     => 'Comentarios', // Table column heading
            'type' => 'wysiwyg',
            'escaped' => false,
            'limit'  => -1, // character limit; default is 50;
            
            // 'prefix' => 'Name: ',
            // 'suffix' => '(user)',
            // 'limit'  => 120, // character limit; default is 50;
        ]);

        CRUD::addField([
            'name'      => 'user_id', // The db column name
            'label'     => 'created_by', // Table column heading
            'type' => 'hidden',
            'value' => backpack_auth()->user()->id,
            // 'wrapper'   => [
            //     'class' => 'form-group col-md-4'
            // ],
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
