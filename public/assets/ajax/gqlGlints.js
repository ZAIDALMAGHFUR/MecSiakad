
$(document).ready(function() {
    var query = `
    query searchJobs($data: JobSearchConditionInput!) {
        searchJobs(data: $data) {
          jobsInPage {
            id
            title
            isRemote
            status
            createdAt
            updatedAt
            isActivelyHiring
            isHot
            shouldShowSalary
            salaryEstimate {
              minAmount
              maxAmount
              CurrencyCode
              __typename
            }
            company {
              ...CompanyFields
              __typename
            }
            citySubDivision {
              id
              name
              __typename
            }
            city {
              ...CityFields
              __typename
            }
            country {
              ...CountryFields
              __typename
            }
            category {
              id
              name
              __typename
            }
            salaries {
              ...SalaryFields
              __typename
            }
            location {
              ...LocationFields
              __typename
            }
            minYearsOfExperience
            maxYearsOfExperience
            source
            __typename
          }
          totalJobs
          __typename
        }
      }
      
      fragment CompanyFields on Company {
        id
        name
        logo
        __typename
      }
      
      fragment CityFields on City {
        id
        name
        __typename
      }
      
      fragment CountryFields on Country {
        code
        name
        __typename
      }
      
      fragment SalaryFields on JobSalary {
        id
        salaryType
        salaryMode
        maxAmount
        minAmount
        CurrencyCode
        __typename
      }
      
      fragment LocationFields on HierarchicalLocation {
        id
        name
        administrativeLevelName
        formattedName
        level
        parents {
          id
          name
          administrativeLevelName
          formattedName
          level
          __typename
        }
        __typename
      }
      `;

    $.ajax({
        url: 'https://glints.com/api/graphql',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({
            query: query
        }),
        success: function(response) {
            const { jobsInpage } = response.data.searchJobs;
            // var books = response.data.books;
            for(var i = 0; i < books.length; i++) {
                var book = books[i];
                $('#books').append('<p>' + book.title + ' by ' + book.author + '</p>');
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
});