<?php
  use App\Repositories\MemberRepository;
  $repo = new MemberRepository;

  function renderTree ($member, $level, $html) {
    if ($level >= 1) return;
    $repo = new MemberRepository;
    $html = '';
    if ($children = $repo->findChildren($member)) {
      $html .= '<ul>';
      if (count($children) <= 0) {
        $html .= '<li>
            <a href="' . route('member.register', ['lang' => \App::getLocale()]) . '?u=' . $member->username . '&p=left" class="new"><i class="md md-person-add"></i> ' . \Lang::get('binary.register') . '</a>
          </li>
          <li>
            <a href="' . route('member.register', ['lang' => \App::getLocale()]) . '?u=' . $member->username . '&p=right" class="new"><i class="md md-person-add"></i> ' . \Lang::get('binary.register') . '</a>
          </li>';
      } else {
        foreach ($children as $child) {
          if (count($children) < 2 && $child->position == 'right') {
            $html .= '<li>
              <a href="' . route('member.register', ['lang' => \App::getLocale()]) . '?u=' . $member->username . '&p=left" class="new"><i class="md md-person-add"></i> ' . \Lang::get('binary.register') . '</a>
              </li>';
          }

          if ($level < 0) {
            $html .= '<li>
              <a href="#" data-toggle="modal" data-target="#showModal" tabindex="0" role="button" data-id="' . $child->username . '"><i class="md md-accessibility"></i> ' . $child->username . ' (' . strtoupper($child->position[0]) . ')</a>';
          } else {
            $html .= '<li>
              <a href="#" tabindex="0" role="button" data-toggle="modal" data-target="#showModal" data-id="' . $child->username . '"><i class="md md-accessibility"></i> ' . $child->username . ' (' . strtoupper($child->position[0]) . ')</a><a href="#" data-username="' . $child->username . '" data-more="true" title="More"><span class="md md-add"></span></a>';
          }

          $next = $level + 1;
          $html .= renderTree($child, $next, $html);
          $html .= '</li>';

          if (count($children) < 2 && $child->position == 'left') {
            $html .= '<li>
              <a href="' . route('member.register', ['lang' => \App::getLocale()]) . '?u=' . $member->username . '&p=right" class="new"><i class="md md-person-add"></i> ' . \Lang::get('binary.register') . '</a>
              </li>';
          }
        }
      }
      $html .= '</ul>';
    }
    return $html;
  }
?>

<ul id="mainTree">
  <li>
    <a href="#" tabindex="0" role="button" data-toggle="modal" data-target="#showModal" data-id="{{ $model->username }}"><i class="md md-accessibility"></i> {{ $model->username }}</a>
    @if ($children = $repo->findChildren($model)) <!-- render 4 levels -->
      <ul>
        @if (count($children) <= 0)
          <li>
            <a href="{{ route('member.register', ['lang' => \App::getLocale()]) . '?u=' . $model->username . '&p=left' }}" class="new"><i class="md md-person-add"></i> {{ \Lang::get('binary.register') }}</a>
          </li>
          <li>
            <a href="{{ route('member.register', ['lang' => \App::getLocale()]) . '?u=' . $model->username . '&p=right' }}" class="new"><i class="md md-person-add"></i> {{ \Lang::get('binary.register') }}</a>
          </li>
        @else
          @foreach ($children as $child)
            @if (count($children) < 2 && $child->position == 'right')
              <li>
                <a href="{{ route('member.register', ['lang' => \App::getLocale()]) . '?u=' . $model->username . '&p=left' }}" class="new"><i class="md md-person-add"></i> {{ \Lang::get('binary.register') }}</a>
              </li>
            @endif
            <li>
              <a href="#" tabindex="0" role="button" data-toggle="modal" data-target="#showModal" data-id="{{ $child->username }}"><i class="md md-accessibility"></i> {{ $child->username }} ({{ strtoupper($child->position[0]) }})</a>
              {!! renderTree($child, 0, '') !!}
            </li>
            @if (count($children) < 2 && $child->position == 'left')
              <li>
                <a href="{{ route('member.register', ['lang' => \App::getLocale()]) . '?u=' . $model->username . '&p=right' }}" class="new"><i class="md md-person-add"></i> {{ \Lang::get('binary.register') }}</a>
              </li>
            @endif
          @endforeach
        @endif
      </ul>
    @endif
  </li>
</ul>

