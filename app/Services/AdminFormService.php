<?php

namespace App\Services;

use App\Http\Requests\AdminFormRequest;
use App\Models\DistrictFormOrder;
use App\Models\Form;
use Illuminate\Http\Request;

class AdminFormService
{
    public function createForm(AdminFormRequest $request): Form
    {
        $validated_data = $request->validated();

        if ($request->input('type') === 'local') {
            $validated_data += [
                'zipcode' => $request->input('zipcode'),
            ];
        }

        return Form::create($validated_data);
    }

    public function updateForm(AdminFormRequest $request, Form $form): bool
    {
        $this->updateDsitrictOrder($request, $form);

        $inputs = $request->validated();
        if ($request->input('type') == "local") {
            $inputs += ['zipcode' => $request->zipcode];
        }

        return $form->update($inputs);
    }

    public function addFormToDistrictOder(Request $request, $form_id): void
    {
        if ($request->input('type') == "default") {
            $district_forms = DistrictFormOrder::all();
            $this->updateEachDistrict($district_forms, $form_id, 'form_id', 'default_check');
        } else {
            $district_forms = DistrictFormOrder::where('district_id', $request->zipcode)->get();
            $this->updateEachDistrict($district_forms, $form_id, 'local_form_id', 'local_check');
        }
    }

    public function updateDsitrictOrder(Request $request, Form $form)
    {
        $district_forms = DistrictFormOrder::all();
        $form_id = $form->form_id;

        if ($form->type == "default" && $request->type == "local") {
            $this->removeDistrictForm($district_forms, $form_id, 'update', $request->input('zipcode'));
        } else {
            foreach ($district_forms as $destrict_form) {
                $form_id_arr = explode(',', $destrict_form->form_id);
                $default_check_arr = explode(',', $destrict_form->default_check);

                $local_id_arr = explode(',', $destrict_form->local_form_id);
                $local_check_arr = explode(',', $destrict_form->local_check);

                if (in_array($form_id, $local_id_arr, true)) {
                    $this->unsetFormId($destrict_form, $form_id, $local_id_arr, $local_check_arr);
                }

                if ($request->type == "default") {
                    $form_id_arr[] = $form_id;
                    $destrict_form->form_id = implode(',', $form_id_arr);

                    if ($destrict_form->default_check != null) {
                        $default_check_arr[] = 1;
                        $destrict_form->default_check = implode(',', $default_check_arr);
                    }
                } else {
                    $this->updateFormId($destrict_form, $request->zipcode, $form_id, $local_id_arr, $local_check_arr);
                }
                $destrict_form->save();
            }
        }
    }

    /**
     * Remove the specified Form
     *
     * @param  $form_id
     * @return ?bool
     */
    public function destroyForm($form_id): ?bool
    {
        $district_forms = DistrictFormOrder::all();
        $this->removeDistrictForm($district_forms, $form_id, 'delete');

        return Form::where('form_id', $form_id)->delete();
    }

    protected function removeDistrictForm($district_forms, $form_id, string $type = 'update', $zipcode = null): void
    {
        foreach ($district_forms as $district_form) {
            $form_id_arr = explode(',', $district_form->form_id);
            $default_check_arr = explode(',', $district_form->default_check);

            $local_id_arr = explode(',', $district_form->local_form_id);
            $local_check_arr = explode(',', $district_form->local_check);

            if (in_array($form_id, $form_id_arr, true)) {
                $key = array_search($form_id, $form_id_arr, true);
                unset($form_id_arr[$key]);
                $district_form->form_id = implode(',', array_values($form_id_arr));

                if ($district_form->default_check != null) {
                    unset($default_check_arr[$key]);
                    $district_form->default_check = implode(',', array_values($default_check_arr));
                }
            }

            if ($type == 'update') {
                $this->updateFormId($district_form, $zipcode, $form_id, $local_id_arr, $local_check_arr);
            } elseif (in_array($form_id, $local_id_arr, true)) {
                $this->unsetFormId($district_form, $form_id, $local_id_arr, $local_check_arr);
            }

            $district_form->save();
        }
    }

    public function unsetFormId($district_form, $form_id, &$id_arr, &$check_arr): void
    {
        $key = array_search($form_id, $id_arr, true);

        if ($district_form->local_form_id != null) {
            unset($id_arr[$key]);
            $district_form->local_form_id = implode(',', array_values($id_arr));
        }

        if ($district_form->local_check != null) {
            unset($check_arr[$key]);
            $district_form->local_check = implode(',', array_values($check_arr));
        }
    }

    private function updateFormId($districtFormOrder, $zip_code, $form_id, &$local_id_arr, &$local_check_arr): void
    {
        if ($districtFormOrder->district_id == $zip_code) {
            if ($districtFormOrder->local_form_id != null) {
                $local_id_arr[] = $form_id;
                $districtFormOrder->local_form_id = implode(',', $local_id_arr);
            }

            if ($districtFormOrder->local_check != null) {
                $local_check_arr[] = 1;
                $districtFormOrder->local_check = implode(',', $local_check_arr);
            }
        }
    }

    /**
     * @param $district_forms
     * @param $form_id
     * @param $field
     * @param $check_field
     * @return void
     */
    private function updateEachDistrict($district_forms, $form_id, $field, $check_field): void
    {
        foreach ($district_forms as $district_form) {
            $id_arr = explode(',', $district_form->$field);
            $id_arr[] = $form_id;
            $district_form->$field = implode(',', $id_arr);

            if ($district_form->$check_field) {
                $check_arr = explode(',', $district_form->$check_field);
                $check_arr[] = 1;
                $district_form->$check_field = implode(',', $check_arr);
            }

            $district_form->save();
        }
    }


}
