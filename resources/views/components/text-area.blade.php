@props(['disabled' => false])

<textarea :cols="$cols" :rows="$rows" :name="$name" :required="$required"  :placeholder="$placeholder" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}></textarea>
