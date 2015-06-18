<?php

/**
 * MY Model
 *
 * @author  Leonardo Faria
 * @link  http://leonardofaria.net
 */

class MY_Model extends CI_Model {

  /**
   * Find a object based on their attributtes.
   *
   * @access  public
   * @param string
   * @return  string
   */
  public function find($filter = array(), $order = array('id' => 'DESC'), $offset = 0, $per_page = 2000, $filter_not = array())
  {
    // TODO: Refatorar para melhorar o uso de expressões eq, like, neq, etc.

    $query = $this->doctrine->em->getRepository("Entity\\" . get_class($this));
    $criteria = new \Doctrine\Common\Collections\Criteria();

    if (count($filter) > 0)
    {
      foreach ($filter as $key => $value)
      {
        if ($key === "nb" || $key === "ctc")
        {
          $criteria->where($criteria->expr()->contains($key, $value));
        }
        else
        {
          $criteria->where($criteria->expr()->eq($key, $value));
        }
      }
    }

    $criteria->orderBy($order);
    $criteria->setFirstResult($offset);
    $criteria->setMaxResults($per_page);

    if (count($filter_not) > 0)
    {

      foreach ($filter_not as $filter_key => $filter_value)
      {
        if (is_array($filter_value))
        {
          foreach ($filter_value as $filter_value_key => $filter_value_value)
          {
            $criteria->andWhere($criteria->expr()->neq($filter_value_key, $filter_value_value));
          }
        }
        else
        {
          $criteria->andWhere($criteria->expr()->neq($filter_key, $filter_value));
        }
      }
    }

    return $query->matching($criteria);

  }

  public function select_opts($filter = array())
  {

    $query = $this->doctrine->em->getRepository("Entity\\" . get_class($this));
    $options = array('' => 'Selecione', ' ' => ' ');

    if (count($filter) > 0)
    {
      $results = $query->findBy($filter);
    }
    else
    {
      $results = $query->findAll();
    }

    foreach ($results as $row)
    {
      // TODO: Refatorar esse método para personalizar o <option> obtido
      if (get_class($this) === 'Orgao') {
        $options[$row->getId()] = $row->getOl() . ' - ' . $row->getNome();
      } else {
        $options[$row->getId()] = $row->getNome();
      }

    }

    return $options;

  }

  public function count($filter = array(), $filter_not = array())
  {

    $query = $this->doctrine->em->getRepository("Entity\\" . get_class($this));
    $criteria = new \Doctrine\Common\Collections\Criteria();

    if (count($filter) > 0)
    {
      foreach ($filter as $key => $value)
      {
        $criteria->where($criteria->expr()->eq($key, $value));
      }
    }

    if (count($filter_not) > 0)
    {

      foreach ($filter_not as $filter_key => $filter_value)
      {
        if (is_array($filter_value))
        {
          foreach ($filter_value as $filter_value_key => $filter_value_value)
          {
            $criteria->andWhere($criteria->expr()->neq($filter_value_key, $filter_value_value));
          }
        }
        else
        {
          $criteria->andWhere($criteria->expr()->neq($filter_key, $filter_value));
        }
      }
    }

    return count($query->matching($criteria));

  }

  public function update($id, $name, $value)
  {

    try
    {
      $object = $this->doctrine->em->getRepository("Entity\\" . $name);
      $object = $object->findBy(array('id' => $value))[0];
      $value = $object;
    }
    catch (Doctrine\Common\Persistence\Mapping\MappingException $e)
    {
      // O valor passado para ser atualizado não é uma entidade
    }

    // Localizando o registro a ser atualizado
    $entity = $this->doctrine->em->getRepository("Entity\\" . get_class($this));
    $object = $entity->findBy(array('id' => $id))[0];

    $name = "set$name";
    $object->$name($value);

    $this->doctrine->em->persist($object);
    $this->doctrine->em->flush();

  }

}
