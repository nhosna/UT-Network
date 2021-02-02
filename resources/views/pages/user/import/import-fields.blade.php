@extends('layouts.panel')

@section('panelbread')
    {{ Breadcrumbs::render('user.import' ) }}

@endsection

@section('panelhead')
    <h2> Import Users</h2>


@endsection
@section('panelbody')

{{--    <select class="form-control" id="select-license" name="license" multiple--}}
{{--    data-plugin="select2"  style="width: 100%")--}}
{{--    -for(var i = 0; i < possible_options.length; i++)--}}
{{--    -if(inrequirements(i))--}}
{{--    <option value"#{possible_options[i]}" selected disabled>#{possible_options[i]}</option>--}}
{{--    -else--}}
{{--    <option value"#{possible_options[i]}">#{possible_options[i]}</option>--}}
{{--    --}}

    <form class="form-horizontal" method="POST" action="{{ route('user.importprocess') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}" />
                <div class="table-responsive" style="overflow-x: auto ">

                            <table class="table">

                                @foreach ($csv_data as $row)
                                    <tr>
                                        @foreach ($row as $key => $value)
                                            <td>{{ $value }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                <tr>

                                    @foreach ($csv_data[0] as $key => $value)

                                        <td class="form-group  ">
                                                <select class="form-control form-control-lg " name="fields[{{ $key }}]"  >
                                                    @foreach ($db_fields as $fieldIndex => $db_field)
                                                        <option value="{{ $loop->index }}"
                                                                @if ($key === $fieldIndex) selected @endif>{{ $db_field }}</option>
                                                    @endforeach
                                                </select>
                                        </td>

                                    @endforeach
                                </tr>
                            </table>
                </div>

                            <button type="submit" class="btn btn-primary">
                                Import Data
                            </button>
                        </form>







@endsection
