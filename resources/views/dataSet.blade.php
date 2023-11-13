<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>UserId</th>
        <th>UserDNI</th>
        <th>CategoryId</th>
        <th>CategoryName</th>
        <th>Level</th>
        <th>QuestionId</th>
        <th>QuestionName</th>
        <th>UserAnswer</th>
        <th>CorrectAnswer</th>
        <th>Output</th>
    </tr>
    </thead>
    <tbody>
    @foreach($dataSet as $data_set)
        <tr>
            <td>{{ $data_set->id }}</td>
            <td>{{ $data_set->user_id }}</td>
            <td>{{ $data_set->user->dni }}</td>
            <td>{{ $data_set->category_id }}</td>
            <td>{{ $data_set->category->name }}</td>
            <td>{{ $data_set->category->level }}</td>
            <td>{{ $data_set->question_id }}</td>
            <td>{{ $data_set->question->question_name }}</td>
            <td>{{ $data_set->user_answer }}</td>
            <td>{{ $data_set->correct_answer }}</td>
            <td>{{ $data_set->output ? '1' : '0' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>