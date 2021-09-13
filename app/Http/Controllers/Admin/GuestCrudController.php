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
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

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
        CRUD::enableExportButtons();
    }

    public function fetchTable()
    {
        return $this->fetch([
            'model' => \App\Models\Table::class,
            'query' => function($model) {
                $search = request()->input('form.9.value') ?? false;
                if ($search) {
                    return $model->where('event_id', $search);
                }else{
                    return $model;
                }
            },
            'searchable_attributes' => []
        ]);
        return $this->fetch(\App\Models\Table::class);
    }

    public function fetchMenu()
    {
        return $this->fetch([
            'model' => \App\Models\Menu::class,
            'query' => function($model) {
                $search = request()->input('form.9.value') ?? false;
                if ($search) {
                    return $model->where('event_id', $search);
                }else{
                    return $model;
                }
            },
            'searchable_attributes' => []
        ]);
        return $this->fetch(\App\Models\Menu::class);
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

        if(request()->get('menu_id')){
            CRUD::addClause('where', 'menu_id', '=', request()->get('menu_id'));
            CRUD::addButtonFromView('top', 'return', 'return', 'beginning');
        }

        if(request()->get('table_id')){
            CRUD::addClause('where', 'table_id', '=', request()->get('table_id'));
            CRUD::addButtonFromView('top', 'return', 'return', 'beginning');
        }

        CRUD::addFilter([
            'name'  => 'event_id',
            'type'  => 'select2',
            'label' => 'Evento'
        ], function () {
            return \App\Models\Event::all()->keyBy('id')->pluck('name', 'id')->toArray();
        }, function ($value) { // if the filter is active
            $this->crud->addClause('where', 'event_id', $value);
        });

        // CRUD::addFilter([
        //     'name'  => 'menu_id',
        //     'type'  => 'select2',
        //     'label' => 'Menu',
        // ], function () {
        //     if(request()->get('event_id')){
        //         return \App\Models\Menu::where('event_id',request()->get('event_id'))->get()->keyBy('id')->pluck('name', 'id')->toArray();
        //     }
        //     else{
        //         return ['Selecciona un Evento'];
        //     }
        // }, function ($value) { // if the filter is active
        //     $this->crud->addClause('where', 'menu_id', $value);
        // });

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
            'label'     => 'Menu', // Table column headin
            'type'      => 'relationship',
            'name'      => 'menu', // The db column name
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
            'type'      => 'relationship',
            'ajax'      => true,
            'placeholder' => "Selecciona un evento",
            'minimum_input_length' => 0,
            'inline_create' => [ // specify the entity in singular
                'entity' => 'table', // the entity in singular
                // OPTIONALS
                'force_select' => true, // should the inline-created entry be immediately selected?
                'modal_class' => 'modal-dialog modal-xl', // use modal-sm, modal-lg to change width
                'modal_route' => route('table-inline-create'), // InlineCreate::getInlineCreateModal()
                'create_route' =>  route('table-inline-create-save'), // InlineCreate::storeInlineCreate()
                'include_main_form_fields' => ['event_id'], // pass certain fields from the main form to the modal
            ],
            'name'      => 'table_id', // the column that contains the ID of that connected entity;
            'entity'    => 'table', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => "App\Models\Table", // foreign key model
            // 'inline_create' => true,
            'dependencies' => ['event_id'],
            'wrapper'   => [
                'class' => 'form-group col-md-4'
            ],
         ]);

         CRUD::addField([
            // 1-n relationship
            'label'     => 'Menu', // Table column heading
            'type'      => 'relationship',
            'ajax'      => true,
            'placeholder' => "Selecciona un evento",
            'minimum_input_length' => 0,
            'inline_create' => [ // specify the entity in singular
                'entity' => 'menu', // the entity in singular
                // OPTIONALS
                'force_select' => true, // should the inline-created entry be immediately selected?
                'modal_class' => 'modal-dialog modal-xl', // use modal-sm, modal-lg to change width
                'modal_route' => route('menu-inline-create'), // InlineCreate::getInlineCreateModal()
                'create_route' =>  route('menu-inline-create-save'), // InlineCreate::storeInlineCreate()
                'include_main_form_fields' => ['event_id'], // pass certain fields from the main form to the modal
            ],
            'name'      => 'menu_id', // the column that contains the ID of that connected entity;
            'entity'    => 'menu', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => "App\Models\Menu", // foreign key model
            // 'inline_create' => true,
            'dependencies' => ['event_id'],
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
